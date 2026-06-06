from fastapi import FastAPI
from pydantic import BaseModel
import google.generativeai as genai
import json
from sentence_transformers import SentenceTransformer, util

app = FastAPI()

# ⚠️ Ganti dengan API Key valid milikmu dari Google AI Studio
GENAI_API_KEY = "MASUKKAN API ANDA DI SINI"
genai.configure(api_key=GENAI_API_KEY)

# Inisialisasi model SBERT sekali saja saat aplikasi start up agar hemat memori
sbert_model = SentenceTransformer('symanto/sn-xlm-roberta-base-snli-mnli-anli-xnli')

# --- DATA MODEL FOR PYDANTIC ---
class TitleRequest(BaseModel):
    topik: str
    deskripsi: str

class DSSRequest(BaseModel):
    deskripsi_mahasiswa: str
    korpus_penelitian: list  
    korpus_skripsi: list     

# --- ENDPOINT 1: GENERATE JUDUL (GEMINI) ---
@app.post("/api/generate-titles")
def generate_titles(req: TitleRequest):
    model = genai.GenerativeModel('models/gemini-2.5-flash')
    
    prompt = f"""
    Kamu adalah seorang Koordinator Tugas Akhir di jurusan Sistem Informasi Politeknik.
    Berdasarkan input mahasiswa berikut:
    - Topik: {req.topik}
    - Deskripsi Ide/Metode/Tujuan: {req.deskripsi}
    
    Berikan 3 rekomendasi judul skripsi yang sangat spesifik, menggunakan metode ilmiah yang tepat, 
    dan sesuai dengan standar tugas akhir/skripsi mahasiswa vokasi (D4/Politeknik).
    
    Wajib memberikan output dalam format JSON murni tanpa format markdown (jangan gunakan ```json), 
    tanpa teks penjelasan pembuka/penutup, dengan struktur seperti ini:
    {{
      "judul": [
        "Judul Pertama",
        "Judul Kedua",
        "Judul Ketiga"
      ]
    }}
    """
    try:
        response = model.generate_content(prompt)
        clean_text = response.text.strip()
        if clean_text.startswith("```"):
            clean_text = clean_text.split("\n", 1)[1]
        if clean_text.endswith("```"):
            clean_text = clean_text.rsplit("\n", 1)[0]
            
        return json.loads(clean_text.strip())
    except Exception as e:
        return {"judul": [f"Gagal generate judul otomatis: {str(e)}"]}

# --- ENDPOINT 2: HITUNG SEMANTIK SBERT ---
@app.post("/api/calculate-similarity")
def calculate_similarity(req: DSSRequest):
    try:
        mahasiswa_embedding = sbert_model.encode(req.deskripsi_mahasiswa, convert_to_tensor=True)
        penelitian_embeddings = sbert_model.encode(req.korpus_penelitian, convert_to_tensor=True)
        skripsi_embeddings = sbert_model.encode(req.korpus_skripsi, convert_to_tensor=True)
        
        scores_c1 = util.cos_sim(mahasiswa_embedding, penelitian_embeddings).tolist()[0]
        scores_c2 = util.cos_sim(mahasiswa_embedding, skripsi_embeddings).tolist()[0]
        
        return {
            "status": "success",
            "scores_c1": scores_c1,
            "scores_c2": scores_c2
        }
    except Exception as e:
        return {
            "status": "error",
            "message": str(e),
            "scores_c1": [0.0] * len(req.korpus_penelitian),
            "scores_c2": [0.0] * len(req.korpus_skripsi)
        }
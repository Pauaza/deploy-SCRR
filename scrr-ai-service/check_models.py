# scrr-ai-service/check_models.py
import google.generativeai as genai

# Ganti dengan API Key Gemini kamu
GENAI_API_KEY = "AIzaSyDBw1XLO9pm0bfB2g-9Vs-x3rlCqrnvpEE"
genai.configure(api_key=GENAI_API_KEY)

print("--- Memeriksa Model yang Tersedia untuk generateContent ---")
try:
    for m in genai.list_models():
        if 'generateContent' in m.supported_generation_methods:
            print(f"Nama Model: {m.name}")
except Exception as e:
    print(f"Terjadi kesalahan saat memeriksa model: {e}")
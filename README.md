QR Code Generator — Laravel + Vue

🚀 Installation rapide

Backend (Laravel)
cd backend
composer install
cp .env.example .env
php artisan key:generate
# configure la BDD MySQL dans .env
php artisan migrate
php artisan serve
# http://127.0.0.1:8000

Frontend (Vue 3 + Vite)
cd frontend
npm install
npm run dev
# http://127.0.0.1:5173

📌 API

POST /api/qrcodes → Génère et enregistre un QR code

GET /api/qrcodes → Liste l’historique des QR codes


⚡ Workflow dev

Lancer le backend : php artisan serve

Lancer le frontend : npm run dev


Ouvrir http://127.0.0.1:5173
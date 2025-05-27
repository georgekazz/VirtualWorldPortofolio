<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <strong>AR_edutainment</strong><br>
  A web platform to showcase student AR projects, built with Laravel, TailwindCSS & Three.js.
</p>

---

## 📚 Περιγραφή / Description

Το **AR_edutainment** είναι μια web πλατφόρμα που φιλοξενεί εφαρμογές Επαυξημένης Πραγματικότητας (AR) που έχουν αναπτυχθεί από φοιτητές στο πλαίσιο Πτυχιακών και Διπλωματικών Εργασιών, υπό την επίβλεψη του καθηγητή **Ευκλείδη Κεραμόπουλου**.

This platform is designed to host and present Augmented Reality projects created by students, using modern web technologies.

---

## ✨ Τεχνολογίες / Tech Stack

- [Laravel 10+](https://laravel.com) – PHP Framework
- [Tailwind CSS](https://tailwindcss.com) – Utility-first CSS framework
- [Three.js](https://threejs.org) – JavaScript 3D rendering engine
- [Font Awesome](https://fontawesome.com) – Icons
- [JavaScript / Canvas](https://developer.mozilla.org/en-US/docs/Web/API/Canvas_API) – Custom cursor trail effect

---

## 🖥 Live Preview

🚀 **[Δες την πλατφόρμα live (ανέβασε σε hosting πρώτα)](#)**

---

## 📁 Εγκατάσταση / Installation

```bash
git clone https://github.com/yourusername/ar_edutainment.git
cd ar_edutainment
composer install
npm install && npm run dev
copy .env.example .env
php artisan migrate
php artisan db:seed
php artisan key:generate

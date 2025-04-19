# 🚗 CarSpotterHub

Welcome to **CarSpotterHub** — a modern, professional car information portal built for enthusiasts, researchers, and curious minds alike. Whether you're a speed junkie or just love cars, this site is your go-to hub for discovering detailed vehicle specs and more.

---

## 🌟 Features

- 🔍 **Powerful Search**: Instantly search cars by name with real-time result updates.
- 📦 **CDN-Optimized Images**: Vehicle images and brand logos are stored in Google Cloud Console and delivered via CDN for better performance and reduced database weight.
- 🏎️ **Detailed Car Pages**: 
  - Engine type
  - Horsepower
  - 0–60 time
  - Brand logo (from CDN)
  - Special features
  - A short but rich description
- 📰 **Informative Articles**:
  - Current articles such as *Electric vs. Gas Cars*
- 🧠 **Smart Index Page**:
  - Modern UI featuring **highlighted cars** and **recently added vehicles** in elegant card layouts.
- 📱 **Mobile Friendly**: The entire website is fully responsive and works beautifully on mobile screens.

---

## 🔐 Admin Panel

The website includes a secured admin panel for managing content.

- **Main Admin**:
  - Add co-admins
- **Co-Admins**:
  - Add new cars, new brands, upload CDN links for images/logos, and manage vehicle information
- 👤 **Role Separation**:
  - Only **one main admin**
  - Co-admins can't create other co-admins

**🔑 Admin Panel Test Login:**

Username: csh-co
Password: 0000

---

## 📊 Current Data

- ✅ **6 Cars** added to the database so far

---

## 🔮 Planned Features

Here's what’s coming next:

- 📝 More in-depth articles
- 🏷️ Brand detail pages (click on a brand name to explore more)
- 🔧 Admin tools:
  - Co-admin removal
  - Password management
  - General improvements to backend UX

---

## 🛠️ Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (via phpMyAdmin)
- **Cloud Storage**: Google Cloud Console (CDN image delivery)

---

## 🖼️ Screenshots

> _Add the image files to your repo under `/assets` and update the links below accordingly._

**🏠 Index Page**  
![Index Page](assets/index-page-1.png)

**🏎️ Vehicle Info Page**  
![Car Info](assets/vehicle-info-page.png)

**🛠️ Admin Panel**  
![Admin Panel](assets/admin-panel.png)

---

## 📁 Project Structure

bash
CarSpotterHub/
├── index.html
├── /css
├── /js
├── /php
├── /images (optional, only used if not on CDN)
├── /admin
├── /articles
└── README.md

---

## 🧪 Local Setup
- Clone the repository
  - git clone https://github.com/ItsKalfox/CarSpotterHub.git

- Import the database using phpMyAdmin

- Make sure your config.php points to your local MySQL settings

- Host the site on XAMPP or any PHP-supported local server

---

## 👤 Author
- Created with 💻 and 🦊 by
 **Kalfox**
 *A TailCoded Studio Project*
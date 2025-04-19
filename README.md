# CarSpotterHub

**CarSpotterHub** is a modern, professional website that contain exotic car information portal built for enthusiasts, researchers, and curious minds alike. Whether you're a speed junkie or just love cars, this site is your go-to hub for discovering detailed vehicle specs and more.

---

## Features

- **Powerful Search**: Instantly search cars by name with real-time result updates.
- **CDN-Optimized Images**: Vehicle images and brand logos are stored in Google Cloud Console and delivered via CDN for better performance and reduced database weight.
- **Detailed exotic car info**: 
  - Engine type
  - Horsepower
  - 0–60 time
  - Special features
  - A short but rich descriptions
- **Informative Articles**:
- **Smart Index Page**:
  - Modern UI featuring exotic cars in elegant card layouts.
- **Mobile Friendly**: The entire website is fully responsive and works beautifully on mobile screens.

---

## Screenshots

**Index Page**  
<img src="https://storage.googleapis.com/kalfoximg/github-media/carspotterhub/csh-ss-01.gif" alt="Kalfox Logo" width="450" /><br>
<img src="https://storage.googleapis.com/kalfoximg/github-media/carspotterhub/csh-ss-02.png" alt="Kalfox Logo" width="450" />

**Car Details Page**  
<img src="https://storage.googleapis.com/kalfoximg/github-media/carspotterhub/csh-ss-03.png" alt="Kalfox Logo" width="450" />

**Admin Panel**  
<img src="https://storage.googleapis.com/kalfoximg/github-media/carspotterhub/csh-ss-04.png" alt="Kalfox Logo" width="450" />

---

## Admin Panel

The website includes a secured admin panel for managing content.

- **Main Admin**:
  - Add co-admins, add new cars, new brands, upload CDN links for images/logos, and manage vehicle information, etc.
- **Co-Admins**:
  - All of main-admin privileges except adding co_admins.
- **Role Separation**:
  - Only **one main admin**
  - Co-admins can't create other co-admins

**Admin Panel Co-admin Login:**  
Username: csh-co  
Password: 0000

---

## Planned Features

Here's what’s coming next:

- More in-depth articles
- Brand detail pages (click on a brand name to explore more)
- Admin tools:
  - Co-admin removal
  - Password management
  - General improvements to backend UX

---

## Tech Stack

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: PHP
- **Database**: MySQL (via phpMyAdmin)
- **Cloud Storage**: Google Cloud Console (CDN image delivery)

---

## Setup Instructions

- Clone the repository
  - git clone https://github.com/ItsKalfox/carspotterhub.git

- Import the `database/cardatabase.sql` file using phpMyAdmin.

- Make sure your `db/config.php` points to your local MySQL settings.

- This project uses a `<base>` tag to define the root folder for all links and assets.  
By default, it's set to: `<base href="./">`  
To setup a custom directory, change the `<base>` tag path in `includes/header.php`. *(Example: `<base href="/CarSpotterHub/">`)*

---

## 📁 Project Structure

```bash
CarSpotterHub/
├── index.php                 # Homepage of the website
├── temp.php                  # Temporary test page
├── car-details.php           # Detailed information about a selected car
├── /articles/
│   ├── about_us.php          # Background information about the website and company
│   ├── article_1.php         # Article: Electric vs. Hybrid vs. Traditional Engines
│   └── article_2.php         # Article: Future of Autonomous Vehicles
├── /admin/
│   ├── login.php             # Admin login page
│   ├── admin_panel.php       # Admin dashboard for managing site content
│   └── add_co_admin.php      # Handle for adding new co-admins
├── /assets/
│   ├── /css/                 # Stylesheet files
│   ├── /js/                  # JavaScript files
│   └── /img/                 # Images and videos
├── /handlers/
│   └── search_cars.php       # Handle for car search fuction
├── /includes/
│   ├── header.php            # Page header section
│   ├── nav.php               # Site navigation bar
│   └── footer.php            # Page footer section
├── /db/
│   └── config.php            # Database connection configuration
└── /database/
    └── cardatabase.sql       # Exported database file
```

---

## Author
Created by **Kalfox**  
*A TailCoded Studio Project*

---

## License

This project is licensed under the [MIT License](LICENSE).

**Important:** You may not remove or replace any TailCoded branding, logos, or credits. Attribution to **Kalfox** (developer) and **TailCoded** (studio) must be retained in both source code and UI where originally placed.
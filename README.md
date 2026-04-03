# 🏄‍♂️ Taghazout Surf Expo - Surf School Management

A premium, modern web platform designed for managing surf schools. This application provides a comprehensive administrative dashboard for tracking students, lessons, and enrollments while offering a sleek "Dark Ocean" user experience.

## 🚀 Features

- **✨ Premium Landing Page**: A high-end, cinematic home page that introduces the platform and guides users to join.
- **📊 Advanced Analytics Dashboard**: Real-time visual statistics using Chart.js for student levels and payment statuses.
- **👥 Student Management**: Complete CRUD (Create, Read, Update, Delete) functionality for student profiles with multi-field search (Name, Country).
- **🌊 Lesson Scheduling**: Create and manage surf lessons with specific coaches and automated date/time filtering.
- **📝 Enrollment & Payments**: Seamlessly enroll students in lessons and track their payment status (Paid/Pending).
- **🔍 Universal Search**: Enhanced search bar functionality across all tabs to quickly find any record.
- **🔒 Secure Authentication**: Robust login and registration system with role-based access control (Admin/Student).
- **📱 Responsive Design**: Fully responsive UI built with pure CSS, tailored for both desktop and mobile viewing.

## 🛠️ Tech Stack

- **Backend**: PHP (MVC-friendly Procedural Structure)
- **Database**: MySQL (PDO)
- **Frontend**: HTML5, Vanilla CSS3 (Custom Design System)
- **Visuals**: Chart.js for data visualization, FontAwesome for iconography
- **Typography**: Inter (Google Fonts)

## 📂 Project Structure

```text
├── assets/          # CSS design system, JS, and global icons
├── config/          # Database connection and SQL schema files
├── controllers/     # Application logic (The "Brain")
├── models/          # Database interaction (The "Data Layer")
├── public/          # Entry points (The file users access via URL)
├── views/           # UI Templates and HTML structure
└── index.php        # Main entry point and routing redirect
```

## ⚙️ Installation & Setup

1. **Environment**: Ensure you have **XAMPP** or a similar PHP/MySQL environment installed.
2. **Database**: 
   - Open phpMyAdmin.
   - Create a new database named `surfschool_db`.
   - Import the `config/surfschool_db.sql` file.
3. **Configuration**: 
   - Ensure `config/database.php` matches your local MySQL credentials.
4. **Run**: 
   - Copy the project folder to your `htdocs` directory.
   - Navigate to `http://localhost/SurfSchool-Project` in your browser.

## 🛡️ Security & Performance

- **PDO Prepared Statements**: All database queries are protected against SQL injection.
- **Session Management**: Secure user sessions ensure only authorized administrators can access the management panel.
- **Modular Code**: Separated logic and views for high maintainability and easy scalability.

---

*Designed & Developed as part of the Taghazout Surf Expo Management Project.*

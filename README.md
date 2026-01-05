<<<<<<< HEAD
# 🎓 School Management System

A complete **School Management System** designed to manage students, employees, fees, attendance, salaries, and academic operations efficiently.  
Built with a **structured relational database** to ensure accuracy, scalability, and easy reporting.

---

## 🚀 Features

### 👤 User Management
- Role-based users: **Admin, Teacher, Student, Employee**
- Secure authentication and profile management
- Personal information, roles, and status tracking

### 🎓 Student Management
- Student enrollment and assignment by:
  - Academic year
  - Class
  - Subject
  - Study time (Morning / Afternoon)
- Student promotion by academic year
- Fee category assignment per student

### 📚 Academic Management
- Manage:
  - Classes
  - Subjects
  - Study times
  - Academic years
- Flexible structure for multi-year school operations

### 💰 Fee Management
- Define multiple fee categories (Tuition, Exam, Library, etc.)
- Set fee amounts by class
- Student fee payment tracking
- Student-specific fee discounts
- Accurate fee calculation and reporting

### 🧑‍💼 Employee Management
- Employee attendance tracking
- Salary management with increment history
- Employee leave management
- Salary payment records

---

## 🗄️ Database Structure

### Core Tables
| Table | Description |
|------|------------|
| users | Stores all system users |
| assign_student | Assigns students to class, year, subject |
| classes | Class information |
| subjects | Subject list |
| years | Academic years |
| study_time | Study shifts |

### Fee Management Tables
| Table | Description |
|------|------------|
| fee_categories | Types of fees |
| fee_category_amounts | Fee amount per class |
| account_student_fees | Student payment records |
| discount_students | Student fee discounts |

### Employee Tables
| Table | Description |
|------|------------|
| employee_attendance | Daily attendance |
| employee_salary_log | Salary history |
| employee_leave | Leave records |
| account_employee | Salary payments |

---

## 🔗 Relationships Overview
- One **user** can be a student or an employee
- Students are assigned to classes via `assign_student`
- Fees depend on **class + fee category**
- Employees have attendance, salary logs, and leave records
- Academic year is referenced across student and fee records

---

## 🛠️ Tech Stack
- **Frontend:** HTML, CSS, JavaScript
- **Backend:** Laravel (PHP)
- **Database:** MySQL
- **Design:** ERD created with DrawSQL

---

## 📊 Use Cases
- Student enrollment & academic tracking
- Fee calculation with discount support
- Employee payroll & attendance management
- Year-based academic and financial reports
- Role-based access control

---

## 📌 Future Improvements
- Parent portal
- Online assignments & exams
- Automated report cards
- Notifications (SMS / Email)
- REST API integration

---

## 🤝 Contribution
Contributions, suggestions, and improvements are welcome.  
Feel free to fork this repository and submit a pull request.


## ⚙️ Installation & Setup

Follow the steps below to set up the project locally.

### 1. Clone the repository
```bash
git clone https://github.com/Sroun-Pisey/School_Managment_System.git
cd School_Managment_System

2. Install PHP dependencies
composer install

3. Environment configuration
cp .env.example .env
php artisan key:generate


Edit the .env file and configure your database credentials.

4. Run database migrations
php artisan migrate

5. Install frontend dependencies
npm install
npm run dev

6. Start the development server
php artisan serve


The application will be available at:
http://127.0.0.1:8000


---

## 📘 Explanation (For Better Understanding)

### 1️⃣ Clone the project from GitHub
- Download the project to your local machine

### 2️⃣ Install PHP dependencies
- Install Laravel packages and generate the `vendor/` directory

### 3️⃣ Environment setup
- Copy `.env.example` to `.env`
- Generate the application key (required)

### 4️⃣ Database configuration
- Create a database using phpMyAdmin
- Update `DB_DATABASE`, `DB_USERNAME`, and `DB_PASSWORD` in the `.env` file
- Run database migrations using `php artisan migrate`

### 5️⃣ Install frontend dependencies
- Install frontend libraries (Vite, Tailwind CSS, JavaScript)

### 6️⃣ Run the application
- Start the development server and access the project in your browser

---

## ⭐ Optional (Professional Touch)

You may add the following section if your project includes database seeders:


# School_Managment_System
School Management System with Students, Fees, and Employee Management
>>>>>>> e9f4e99fe5ff239c6d93ae43f9fab8b5b7ca1a9e

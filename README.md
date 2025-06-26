
<p align="center">
  <img src="https://github.com/dinonIsaig/Instock-Crud/blob/main/Assets/logo.png" alt="InStock Logo" width="200">
</p>



## 🗂️ About the Repository

This repository contains the code and assets for **InStock**, a web-based inventory management system developed by **BSIT 2-5, S.Y. 2024–2025**. Built using **PHP with MySQL**, InStock is a CRUD (Create, Read, Update, Delete) application designed to help warehouse companies, logistics providers, and production teams efficiently manage their inventory.

---

## 🖥️ Technology Used 

---

💻 **PHP**  
A server-side scripting language used for dynamic web development.

<p align="left">
<a href="https://www.php.net/ " target="_blank" rel="noreferrer">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/php/php-original.svg " alt="PHP" width="40" height="40"/>
</a>
</p>

---

💻 **HTML**  
The standard markup language used to create and structure web pages.

<p align="left">
<a href="https://developer.mozilla.org/en-US/docs/Web/HTML " target="_blank" rel="noreferrer">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/html5/html5-original.svg " alt="HTML5" width="40" height="40"/>
</a>
</p>

---

🎨 **CSS**  
A stylesheet language used to control the presentation and layout of web pages.

<p align="left">
<a href="https://developer.mozilla.org/en-US/docs/Web/CSS " target="_blank" rel="noreferrer">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/css3/css3-original.svg " alt="CSS3" width="40" height="40"/>
</a>
</p>

---

⚙️ **Bootstrap**  
A popular front-end framework for developing responsive and mobile-first websites.

<p align="left">
<a href="https://getbootstrap.com/ " target="_blank" rel="noreferrer">
<img src="https://raw.githubusercontent.com/devicons/devicon/master/icons/bootstrap/bootstrap-original.svg " alt="Bootstrap" width="40" height="40"/>
</a>
</p>
---

# PHP Complete CRUD Application

## Creating the Database Tables

Create a table named `crud` inside your MySQL database using the following code.

```sql
CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `accType` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
);


CREATE TABLE `user` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `first_name` varchar(50) NOT NULL,
    `last_name` varchar(50) NOT NULL,
    `email` varchar(100) NOT NULL,
    `password` varchar(255) NOT NULL,
    `accType` varchar(50) NOT NULL,
    PRIMARY KEY (`id`)
);


CREATE TABLE `production` (
    `ProductionID` int(11) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) NOT NULL,
    `ProductName` varchar(25) NOT NULL,
    `DateProduced` date NOT NULL,
    `Quantity` int(11) NOT NULL,
    PRIMARY KEY (`ProductionID`),
);


CREATE TABLE `warehouse` (
    `StockID` int(11) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) NOT NULL,
    `ProductName` varchar(25) NOT NULL,
    `PricePerUnit` varchar(25) NOT NULL,
    `AvailableStocks` int(11) NOT NULL,
    PRIMARY KEY (`StockID`),
);


CREATE TABLE `logistics` (
    `TransactionID` int(6) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) NOT NULL,
    `OrderName` varchar(25) NOT NULL,
    `DateOrdered` date NOT NULL,
    `Quantity` int(4) NOT NULL,
    PRIMARY KEY (`TransactionID`),
);
```

## Copy files to htdocs folder
Download the above files. Create a folder inside htdocs folder in xampp directory. Finally, copy ur created folder inside htdocs folder. Now, visit localhost/"name of your folder" in your browser and you should see the application.


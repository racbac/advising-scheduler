A note on the documentation: This document is meant to be used as a github readme.md file. It is written in git markdown and is best viewed there because the links, files, and images are interactive.

### 1. Introduction of Team
+ Felipe Bastos fbastos1@umbc.edu - GUI, User Experience 
+ Rachel Brackert bac2@umbc.edu - Student Manager 
+ Travis Earley te4@umbc.edu - Advisor Manager 
+ Nathaniel Fuller fullern1@umbc.edu - Schedule, Appointment Manager 
+ Colin Ganley cganley1@umbc.edu - User Authentication, Database management, Documentation 
 
### 2. Location of Project 
 
The [Source Code](https://github.com/cganley1/cs331-proj2) can be found on github; this is a private repository. Please email Colin for access. 
 
#### 2a. To get to the project 
A working application can be found [on the UMBC student web environment](https://swe.umbc.edu/~cganley1/cs331-proj2/). 
 
To log into the project there are two example user accounts with separate roles. The information for each is: 

User Student: 
 + Campus ID: st1234 
 + Password: password 
 
User Advisor: 
 + Username: ad1234 
 + Password: password 
 
### 3. Project Description 
The College of Natural and Mathematical Sciences (CNMS) Advising Sign-up Web Application. This is a web application to aid in the advising registration process for the CNMS. The aim is to eliminate the paper process that is currently used to handle advising scheduling.

The application follows the feature list and layout as indicated by the provided documentation. Some documentation is found [here](http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/). Specifically, we paid close attention to the feature list and workflow found [here](http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/CNMSElectronicGroupAdvisingSign-upProject.pdf). The remaining documentation is found on Blackboard. 

The original project files were created by another group within the class. They were heavily edited based on the project documentation. In short, our application gives advisors an ability to set up appointments, and students to schedule those appointments; these appointments can be viewed in a calendar format. Each user type for the application has different functionalities such as the ability to change personal preferences, set up meetings, close all meeting scheduling, and ability to search through meetings. 
 
### 4. What was added to the old code? 
 + Added utility scripts for development workflow improvements, specifically for adding license and file headers
 + Appointments can be downloaded in a CSV file 
 + Appointments can be edited 
 + A UMBC themed CSS formatting 
 + A user specific homepage for each respective user 
 + We removed all deprecated files
 + An advisor's ability to shut off student scheduling
 
#### 4a. Why do we deserve an 'A'? 
Our improved functionality makes the application more appealing to the advising team and better suits their workflow. With the addition of the formatting the application is user-friendly and professional looking. It follows an intuitive workflow with easy to understand error messages. All code is commented and edited for readibility. The provided documentation is verbose and thorough.
 
### 5. What was improved upon if given old code? 
 + Reorganized the directory tree based on app's functionality; each 'module' is now located within its own directory for better file management
 + Code was uncommented, we improved the internal documentation for future development and ease of grading 
 + Data schema; we reworked the data tables into three smaller tables that improve functionality 
 + Overall layout and flow of application to improve the user experience
 + In general, we heavily edited all provided files for major functionality rewrites
 
### 6. Database Setup 
The application runs on the UMBC provided MariaDB which uses MySQL. To access the project tables run on your GL account: 
 
    ` mysql -h studentdb-maria.gl -u 'cganley1' -p `
 
The password for the project is peasandcarrots. These credentials are stored in the CommonMethods.php file. 
 
We used four tables. Three are documented because the fourth table tracks a boolean to turn on and off seasonal advising. This table can be expanded to include other application wide preferences. Currently it is trivial to implment as it tracks a single boolean. Run: 

` CREATE TABLE IF NOT EXISTS offseason (
  index int(11) NOT NULL AUTO_INCREMENT,
  closed tinyint(4) NOT NULL DEFAULT '0' COMMENT '0 = Open 1 =Closed',
  PRIMARY KEY (index)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ; `
 
#### 6a. Screen Captures 
The following screen captures show the data schema for each of the three tables during development. Please note that the data shown is used for testing and development and is not production worthy. However, the data schema remains the same for production. 
 
Users Table: 
![alt text](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/cs331_users_data.png "Users data") 

Users Schema:
![alt text](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/cs331_users_schema.png "Users schema") 
 
Students Academic Info Table:
![alt text](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/cs331_acinfo_data.png "Appointments data") 
 
Students Academic Info Schema:
![alt text](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/cs331_acinfo_schema.png "Appointments data") 
 
Appointments Table Data: 
![alt text](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/cs331_appointments_data.png "Appointments data") 
 
Appointments Table Schema:
![alt text](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/cs331_appointments_schema.png "Appointments schema") 
 
#### 6b. Explain why it is set up the way it is 
The following mySql commands will create the required tables. Three tables logically divide the functionality of the application and preserve modularity. When running the commands place smart quotes around the table name. 
 
Our users table stores all information about a relevant user including a password hash. This table can be updated to include many users beyond the required two such as admin, staff, and faculty. 
 
` CREATE TABLE users ( 
  firstName varchar(30) NOT NULL, 
  lastName varchar(30) NOT NULL, 
  username varchar(20) NOT NULL, 
  email varchar(50) NOT NULL, 
  password varchar(128) NOT NULL, 
  userRole varchar(30) NOT NULL
  );
`
 
The students academic info table stores information about a student's academic interests and ties this data to an appointment id. It is important to note that the major is an enum type; these students are only in the CNMS majors. When selected other, a student is prompted with an error in the application.
 
` CREATE TABLE students_academic_info ( 
  username varchar(10) NOT NULL, 
  preferredName varchar(20), 
  campusID varchar(8) NOT NULL, 
  major enum('Biological Sciences B.A.','Biological Sciences B.S.','Biochemistry & Molecular Biology B.S.','Bioinformatics & Computational Biology B.S.','Biology Education B.A.','Chemistry B.A.','Chemistry B.S.','Chemistry Education B.A.','Other') NOT NULL, 
  futurePlans text, 
  advisingQuestions text, 
  appointmentID int(11) 
  ); ` 
 
The data in the appointments table is originally generated by an advisor that wants open appointments. This table is then referenced by a student who wants to schedule a specific appointment. We track the maximum number of students and the currently scheduled students as well. 
 
` CREATE TABLE appointments ( 
  appointment_ID int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
  advisor_ID varchar(20) NOT NULL, 
  date date NOT NULL, 
  start_time time NOT NULL, 
  end_time time NOT NULL, 
  location varchar(20) NOT NULL, 
  max_students tinyint(3) NOT NULL, 
  curr_students tinyint(3) NOT NULL, 
  status tinyint(1) NOT NULL 
  ); ` 
 
#### 6c. DB dump 
 
The following are links to documents for the data table dumps.
+ [Appointments](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/appointments.pdf)
+ [Student Academic Info](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/students_academic_info.pdf)
+ [Users](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/users.pdf)
 
### 7. Languages Used 
The application uses a standard web stack. All new code is original to the development team and all provided code was writted by another group within the class. We used no libraries and no javascript.
 
#### 7a. What was used and where 
Our frontend used HTML and CSS for the web layout, page mapping, and formatting

Our business logic middle layer used php and is the langauge the majority of the application is written in.

The backend database uses mySQL on the provided UMBC web resources. See (6) for details.
 
### 8. Slick Sheet 
 
Please see [Google Drive](https://docs.google.com/document/d/1W0aIoW7XkdZYBNf-CQQ7r1iyJD0bYwf512aDNo5ym-E/edit?usp=sharing) 
 
### 9. Support Videos and Other Documentation
 
A link will be provided [here](https://www.youtube.com/watch?v=cmw2qyPZXAs&). 
 
The provided documentation from the original developers is deprecated, however a link is provided [here](https://swe.umbc.edu/~cganley1/cs331-proj2/Documentation/original_documentation.txt).  

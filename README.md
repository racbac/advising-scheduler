# CMSC 331 Project 2 Fall 2016

### Project Collaborators
+ Felipe Bastos fbastos1@umbc.edu - GUI, User Experience
+ Rachel Brackert bac2@umbc.edu - Student Manager
+ Travis Earley te4@umbc.edu - Advisor Manager
+ Nathaniel Fuller fullern1@umbc.edu - Schedule, Appointment Manager
+ Colin Ganley cganley1@umbc.edu - User Authentication, Database management, Documentation

### Location of Project
A working application can be found [on the UMBC student web environment](https://swe.umbc.edu/~cganley1/cs331-proj2/).

The [Source Code](https://github.com/cganley1/cs331-proj2) can be found on github; this is a private repository. Please email Colin for access.

### Project Description
The College of Natural and Mathematical Sciences (CNMS) Advising Sign-up Web Application. This is a web application to aid in the advising registration process for the CNMS. The application follows the feature list and layout as indicated by the provided documentation. Some documentation is found [here](http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/). The remaining documentation is found on Blackboard. The original project files were created by another group within the class. They were heavily edited based on the project documentation. Included here is the feature list of the application, its architecture, and changelog from the original design.

#### Features
 + User registration and login. Currently two there are two user groups, students and advisors
 + Ability to edit user information
 + ...

#### Architecture
There are four modules to the project each housed in their own directory.
+ AdvisorManager - creation and update of advisor user information
+ AppointmentManager - creation and update of scheduled appointments, provides a calendar view of schedule.
+ LoginPage - user login with authentication
+ StudentManager - creation and update of student user information

An additional directory houses some utilites files for project management

### Original Code Improvements
Changelog:
 + Reorganized directory tree based on app's functionality; each 'module' is now located within its own directory for better file management.
 + Added utility scripts for development workflow improvements, specifically for adding license and file headers.
 + Streamlined the login and registration process. After authentication a user is redirected to his or her approproiate role directory home page with an index of given features.

### Database Organization
The application runs on the UMBC provided MariaDB which uses MySQL. To access the project tables run on your GL account:

    ' mysql -h studentdb-maria.gl -u 'cganley1' -p '

The password for the project is peasandcarrots. These credentials are stored in the CommonMethods.php file.

The following mySql commands will create the required tables

` CREATE TABLE `users` (
  firstName varchar(30) NOT NULL,
  lastName varchar(30) NOT NULL,
  username varchar(20) NOT NULL,
  email varchar(50) NOT NULL,
  password varchar(128) NOT NULL,
  userRole varChar(30) NOT NULL
  ); `

` CREATE TABLE `students_academic_info` (
  username varchar(10) NOT NULL,
  preferredName varchar(20),
  campusID varchar(8) NOT NULL,
  major enum('Biological Sciences B.A.','Biological Sciences B.S.','Biochemistry & Molecular Biology B.S.','Bioinformatics & Computational Biology B.S.','Biology Education B.A.','Chemistry B.A.','Chemistry B.S.','Chemistry Education B.A.','Other') NOT NULL,
  futurePlans text,
  advisingQuestions text,
  appointmentID int(11)
  ); `

` CREATE TABLE `appointments` (
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

### Languages used

#### Frontend
Static HTML pages with CSS formatting.

#### Business Layer
Logic layer written in php. A majority of the application is php based.

#### Backend
UMBC provided MariaDB which uses MySQL.

### Slick Sheet
Provide link here

### Video Presentation Link
Provide link here

## Informal Documentation with Other Bits

### Project Deadlines
 + 2016-Nov-25: Business use cases [https://en.wikipedia.org/wiki/Use_case#Business_Use_Case]
 + 2016-Dec-07: Show client nearly completed project
 + 2016-Dec-19: 23:59.59 Code and documentation
 + 2016-Dec-21: 13:00 Presentation ENGR LAB

### Submitting
`cp proj2.zip /afs/umbc.edu/users/s/l/slupoli/pub/cs331/USERNAME/proj2`

### Project Workflow
Github will be used as the repository manager. Five collaborators work on their own branches to ensure project integrity. When changes are sufficiently finalized, these branches will be merged with master. Each collaborator has his or her own working branch rather than a feature branch.

Please run git pull periodically to pull in changes to master and avoid merge conflicts. When a personal branch is sufficiently modified to include the project changes a pull request will be open. This means that all code submitted is open to peer review. Once appropriate changes are made and with approval, the branch will be merged into master.

Github branching documentation [here](https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging).

Rebasing and squashing [here](https://help.github.com/articles/about-git-rebase/).

### Vulnerabilities

[see](http://www.wikihow.com/Create-a-Secure-Login-Script-in-PHP-and-MySQL)

+ Insecure Php sessions susceptible to XSS and Session Hijacking

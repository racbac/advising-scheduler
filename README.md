# CMSC 331 Project 2

## Formal Documentation

### Project Collaborators
+ Felipe Bastos fbastos1@umbc.edu - GUI, User Experience
+ Rachel Brackert bac2@umbc.edu - Student Manager
+ Travis Earley te4@umbc.edu - Advisor Manager
+ Nathaniel Fuller fullern1@umbc.edu - Schedule, Appointment Manager
+ Colin Ganley cganley1@umbc.edu - User Authentication, Database management

### Location of Project
[On the UMBC student web environment](https://swe.umbc.edu/~cganley1/cs331-proj2/)
[Source Code](https://github.com/cganley1/cs331-proj2) This is a private repository, please email Colin for access.

### Project Description
The College of Natural and Mathematical Sciences (CNMS) Advising Sign-up Web Application. This is an attempt at creating a web application to aid in the advising registration process for the CNMS. The application follows the feature list and layout as indicated by the provided documentation. Some documentation is found [here](http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/). The remaining is on Blackboard.

The original project files were created by another group within the class. These will be reviewed and modified per the developer's discussion.

More on this later.

#### Architecture
There are five modules to the project each housed in their own directory.
+ AdvisorManager - creation and update of advisor user information
+ AppointmentManager - creation and update of scheduled appointments
+ LoginPage - secure user login with authentication
+ ScheduleViewer - calendar view of the scheduled appointments
+ StudentManager - creation and update of student user information

### Original Code Improvements
Changelog:
 + Reorganized directory tree based on app's functionality; each 'module' is now located within its own directory for better file management.
 + Added utility scripts for development workflow improvements, specifically for adding license and file headers.

### Database Organization
The application runs on the UMBC provided MariaDB which uses MySQL. To access the project tables run on your GL account:

    ' mysql -h studentdb-maria.gl -u 'cganley1' -p '

The password for the project is peasandcarrots. These credentials are stored in the CommonMethods.php file.

The following mySql commands will create the required databases

` CREATE TABLE 'secure_login' (
  'id' int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  'username' varchar(30) NOT NULL,
  'password' varchar(50) NOT NULL,
  'username' varchar(128) NOT NULL
  ); `

` CREATE TABLE 'login_attempts' (
  id int(11) AUTO_INCREMENT,
  username varchar(30),
  time varchar(30)
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
2016-Nov-25: Business use cases [https://en.wikipedia.org/wiki/Use_case#Business_Use_Case]
2016-Dec-07: Show client nearly completed project
2016-Dec-20: Code and documentation
2016-Dec-21: 10:00, 11:00, or 13:00 (Felipe may need this changed)  Tentative presentation schedule

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

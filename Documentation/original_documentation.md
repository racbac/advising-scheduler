# Project 1 Documentation
Main Idea: Build an advising website (broken down into an advisor interface and a student interface) that has a feature which replaces the paper documents that advisors currently have students fill out by hand.

## Database:
### Advisor Tables  
- advisors_majors: columns are the id, and each of the eight majors, which store     Boolean values depending on if the advisor can advise that major or not 
- advisor_appts: columns are the id, date, each of the eighteen time blocks (saved as  Boolean values), and the corresponding location each of the eighteen time blocks (saved as text values)	  
-advisor_info: columns are id, username, password (saved with md5 hash), lname, fname, office, and email 
### Student Tables
- students_basic_info: columns are id, lname, fname, email, umbc_ID, and each of the eight majors (set as Boolean values depending on what student selects)
- students_advising_info: columns are `id`, `bio_ba`, `bio_bs`, `biochem_bs`, `bioinfo_bs`, `bioedu_ba`, `chem_ba`, `chem_bs`, `chemedu_ba`, `minor1`, `minor2`, `minor3`,   `minor4`, `futureplans`, `resources`, `experience`, `current_course1`, `current_course2`, `current_course3`, `current_course4`, `current_course5`, `current_course6`, `current_course7`, `current_course8`, `current_course9`, `current_course10`, `next_course1`, `next_course2`, `next_course3`, `next_course4`, `next_course5`, `next_course6`, `next_course7`, `next_course8`, `next_course9`, `next_course10`, `reason_course1`, `reason_course2`, `reason_course3`, `reason_course4`, `reason_course5`, `reason_course6`, `reason_course7`, `reason_course8`, `reason_course9`, `reason_course10`, `credits_course1`, `credits_course2`, `credits_course3`, `credits_course4`, `credits_course5`, `credits_course6`, `credits_course7`, `credits_course8`, `credits_course9`, `credits_course10`, `credits_earned`, `gpa`, `upper_credits`, `writing_intensive`, `phys_ed`, `english`, `arts_hum`, `soc_sci`, `math`, `science`, `culture`, `req_201_lang`, `assessment`, `resource1`, `resource2`, `resource3`, `resoucre4`, `resource5`,  `resource6`, `resource7`, `resource8`, `time_commitments`, `commitment_hours`, `commute`, `new_commute`, `new_work`, `fam_responsibilities`, `new_extracurr`, `new_commutehours`, `new_workhours`, `new_familyhours`, `new_extracurrhours`, `comments`
- student_appts: columns are `id`, `advisor_ID`, `date`, `time`

## Web Pages:
### Advisor Website
- Login
  - username, password
  - has verification
  - Create new account button link to registration page, Login button links to homescreen
- Registration
  - fname, lname, email, ID, password, confirm password, office location, email, majors to advise
  - Register button links to homescreen
- Home Screen
  - links to Edit Appointments, View Appointments, Edit Account Info, and Logout
-Edit Appointments
  - date input for advisors to select day
  - three columns below day: time (checkboxes), type (unsigned int), location          
-View Appointments
  - links to a date selector
  - once date is selected, links to page that displays appointment day, time, type, and location
-Edit Account Info
  - links to a replica of the registration page where advisors can update all of that info
-Logout
  -deletes session variables, ends session

### Student Website
- Login
  - email, password
  - has verification
  - Register button links to registration page, Login button links to homescreen
- Registration
  - fname, lname, email, ID, password, confirm password, major
  - Register button links to homescreen
- Home Screen
  - Links to Search for an Appointment, View My Appointments, Pre-Advising Worksheet, Edit My Information, and Logout
- Search for an Appointment
  - links to a form where student enters ID, selects and appointment date (HTML date input), and selects times (checkboxes) they want to see for that day, and type (all appointments, group appointments, individual appointments)
- View My Appointment
 - queries data from student_appts table and displays
- Pre-Advising Worksheet
  - HTML form with fields the student can fill out and submit
  - data enters the advising_info table 
- Edit My Information
  - links to a replica of the registration page where students can update all of that info
- Logout
  - deletes session variables, ends session

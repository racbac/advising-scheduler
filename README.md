# CMSC 331 Project 2

## Project Collaborators
+ Felipe Bastos fbastos1@umbc.edu
+ Rachel Brackert bac2@umbc.edu
+ Travis Earley te4@umbc.edu
+ Nathaniel Fuller fullern1@umbc.edu
+ Colin Ganley cganley1@umbc.edu


## Project Deadlines
|------------|--------------------------------------|
|2016-Nov-25 | Business use cases [https://en.wikipedia.org/wiki/Use_case#Business_Use_Case] |
|2016-Dec-07 | Show client nearly completed project |
|2016-Dec-20 | Code and documentation |
|2016-Dec-21: 10:00, 11:00, or 13:00 (Felipe may need this changed) | Tentative pres. schedule |

## Submitting
`cp proj2.zip /afs/umbc.edu/users/s/l/slupoli/pub/cs331/USERNAME/proj2`

## Project Workflow
Github will be used as the repository manager. Five collaborators work on their own branches to ensure project integrity. When changes are sufficiently finalized, these branches will be merged with master. Each collaborator has his or her own working branch rather than a feature branch.

Please run git pull periodically to pull in changes to master and avoid merge conflicts. When a personal branch is sufficiently modified to include the project changes a pull request will be open. This means that all code submitted is open to peer review. Once appropriate changes are made and with approval, the branch will be merged into master.

Github branching documentation [here](https://git-scm.com/book/en/v2/Git-Branching-Basic-Branching-and-Merging).

Rebasing and squashing [here](https://help.github.com/articles/about-git-rebase/).

## Project Description

The project files were created by another group within the class. These will be reviewed and modified per the developer's discussion and as indicated in the project description on Blackboard.

## Acceptance Criteria

See this[http://userpages.umbc.edu/~slupoli/notes/ProgLanguages/projects/CollegeWideAdvising/part2/supplements/].

## Architecture

There are five components to the project each housed in their own directory.
+ AdvisorManager - creation and update of advisor user information
+ AppointmentManager - creation and update of scheduled appointments
+ LoginPage - secure user login with authentication
+ ScheduleViewer - calendar view of the scheduled appointments
+ StudentManager - creation and update of student user information

#### Frontent
Static HTML pages with CSS formatting

#### Business Layer
Logic layer writter in php

#### Backend
UMBC provided MariaDB which uses MySQL. To access the project tables run:
    ' mysql -h studentdb-maria.gl -u 'cganley1' -p '
The password for the project is peasandcarrots. These credentials are stored in the CommonMethods.php file.

#### Database Schema
More on this later

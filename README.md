![GitHub repo size](https://img.shields.io/github/repo-size/Joelene241161/MicroFic-Planet?color=000000)
![GitHub top language](https://img.shields.io/github/languages/top/Joelene241161/MicroFic-Planet?color=000000)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/Joelene241161/MicroFic-Planet?color=000000)


<!-- HEADER SECTION -->
<h5 align="center" style="padding:0;margin:0;"> Joelene du Toit
</h5>
<h5 align="center" style="padding:0;margin:0;">241161</h5>
<h6 align="center">DV 200</h6>
</br>
<p align="center">

  <a href="https://github.com/username/projectname">
    <img src="Assets/Logo.svg" alt="Logo" width="140">
  </a>
  
  # MicroFic-Planet

  <p>
    A social platform where users can post and read short (micro) stories.
</p>
<!-- TABLE OF CONTENTS -->
## Table of Contents

* [About the Project](#about-the-project)
  * [Project Description](#project-description)
  * [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)
* [Features and Functionality](#features-and-functionality)
* [Concept Process](#concept-process)
   * [UI design](#UI-design)
   * [Use case diagram](#Use-case-diagram)
   * [Entity Relationship diagram](#Entity-Relationship-diagram)
   * [User flow diagram](#User-flow-diagram)
* [Video Demonstration](#video-demonstration)

<!--PROJECT DESCRIPTION-->
## About the Project
<!-- header image of project -->
![image1][image1]

### Project Description

Microfic-Planet is a social platform that uses a SQL database and written in php. The project was conceptualised from given constraints and the need to fulfill all CRUD operations.

### Built With

* [Xampp](https://www.apachefriends.org/index.html)

<!-- GETTING STARTED -->
<!-- Make sure to add appropriate information about what prerequesite technologies the user would need and also the steps to install your project on their own machines -->
## Getting Started

The following instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

### Prerequisites

Ensure that you have the latest version of [Xampp](https://www.apachefriends.org/index.html) installed on your machine. Then download the repository to your device and use the exported database to view my database's data.

<!-- FEATURES AND FUNCTIONALITY-->
## Features and Functionality

### Engaging with a story

Users can like stories and save stories for later. When they engage they get tokens which they can spend to post a story or gift someone else. When a user removes a like, it removes the tokens they got from the initial like.

![image2][image2]

### Gifting tokens

If a user likes a story they can gift tokens to the writer. On a modal they can choose the amount that they want to gift.

![image3][image3]

### General side bar

Users can view their saved stories and the accounts they follow, if the user is a writer they also have a button that would lead them to the create story page. At first only the two most recent followed accounts and stories show, but when the user clicks on the show all button a modal pops up that shows the rest. Users can also click on usernames that take them to the user's profile. They can also click on the name of a story to take them to that story.

![image4][image4]
![image5][image5]
![image22][image22]
![image23][image23]
![image24][image24]

### Writer side bar

On a writer's profile page they have a different side bar that shows them the accounts that follow them, and the gifts that they have received.

![image6][image6]
![image7][image7]

### Filter

Users can filter stories based on genre. 

![image8][image8]
![image9][image9]

### Create a story

Users can write a story and give it genre tags. When they click post, 40 tokens will be subtracted from their account. A modal will also pop up letting them know that their story is going to go through an approval process.

![image13][image13]
![image14][image14]
![image15][image15]

### Story approval

On an admin's profile page they can view all pending stories. There they can approve or deny a story.

![image16][image16]
![image17][image17]

### Edit and delete story

Writers can edit each story once, they can also choose to delete a story.

![image18][image18]

### Sign up with different roles

When users create an account they can choose the role of writer or reader. Then log in.

![image19][image19]
![image20][image20]

### Log out and delete account

users can log out of their account and delete their account. Before permanently deleting their account, they get a confirmation modal.

![image21][image21]

### Follow account

Users can follow other users.

![image22][image22]

<!-- CONCEPT PROCESS -->
<!-- Briefly explain your concept ideation process -->
## Concept Process

The `Conceptual Process` is the set of actions, activities and research that was done when starting this project.

### Constraints

<strong>Human Truth:</strong> SMALL CONTRIBUTIONS ADD UP

<p>Engaging with other people's posts gives you tokens. You can use these to post stories and gift others.</p>

<strong>Behavioural Twist:</strong> ONE UNDO, EVER

<p>Writers can only edit their stories once after it's been posted.</p>

</strong>Build Constraint:</strong> ONE LOGIN, TWO DIFFERENT ROLES

<p>Users can create an account for the reader/writer role. Then log in on the same page.</p>

### UI design

<img src="Design documentation/UI designs/Guest discover page.png" alt="Guest discover" width="140">
<img src="Design documentation/UI designs/Reader discover page.png" alt="Reader discover" width="140">
<img src="Design documentation/UI designs/Writer discover page.png" alt="Writer discover" width="140">
<img src="Design documentation/UI designs/Discover page filtered results.png" alt="Filtered discover" width="140">
<img src="Design documentation/UI designs/Sign Up.png" alt="Sign up" width="140">
<img src="Design documentation/UI designs/Log In.png" alt="Log in" width="140">
<img src="Design documentation/UI designs/Create story page.png" alt="Create story" width="140">
<img src="Design documentation/UI designs/Account.png" alt="Account" width="140">
<img src="Design documentation/UI designs/Profile (admin).png" alt="Profile admin" width="140">
<img src="Design documentation/UI designs/Profile (another user&apos;s).png" alt="Profile" width="140">
<img src="Design documentation/UI designs/Profile (reader).png" alt="Profile reader" width="140">
<img src="Design documentation/UI designs/Profile (writer).png" alt="Profile writer" width="140">

### Use case diagram

![image10][image10]

### Entity Relationship diagram

![image11][image11]

### User flow diagram

![image12][image12]

### Future Implementation
<!-- stipulate functionality and improvements that can be implemented in the future. -->

* In the future the UI can be refined and some features can be included, such as; the ability to edit your account details, being able to see the approval status of your story, and denied stories not being viewable anywhere on the website.

<!-- VIDEO DEMONSTRATION -->
### Video Demonstration

To see a run through of the application, click below:

[View Demonstration](no link yet)


<!-- MARKDOWN LINKS & IMAGES -->
[image1]: Assets/read%20me/hero.png
[image2]: screenshots/engagement.png
[image3]: screenshots/gift.png
[image4]: screenshots/sidebar.png
[image5]: screenshots/sidebarreader.png
[image6]: screenshots/writersidebar1.png
[image7]: screenshots/writersidebar2.png
[image8]: screenshots/filter1.png
[image9]: screenshots/filter2.png
[image10]: Design%20documentation/Use%20case%20diagram.png
[image11]: Design%20documentation/Entity%20Relationship%20Diagram%20(ERD).png
[image12]: Design%20documentation/user%20flow%20diagram.png
[image13]: screenshots/createstoryempty.png
[image14]: screenshots/createstoryfilled.png
[image15]: screenshots/createstorymodal.png
[image16]: screenshots/admin2.png
[image17]: screenshots/admin1.png
[image18]: screenshots/edit.png
[image19]: screenshots/signup.png
[image20]: screenshots/login.png
[image21]: screenshots/account.png
[image21]: screenshots/following.png
[image22]: screenshots/followedmodal.png
[image23]: screenshots/individualstory.png
[image24]: screenshots/savedmodal.png
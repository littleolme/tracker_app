# tracker_app

Back-end Web Development - Assignment 1
Student ID: u3175611
Tracker App: To Do List
Word count: 558
Site: http://habitual.epizy.com 


What I chose to track:
I chose to create a to do list, or task tracker. At first, I wanted to create a habit tracker, but found that I was out of my depth and needed to start with something simpler. As I already had experience with several to do list apps, and looked at popular ones such as Habitica, Wunderlist, and Todoist, I had a basic idea of what I needed.

Coding:
I first set up the main pages – a create page, update page, listing page, and delete page. 
After the initial set up, my main focus was getting my SQL database connected and working properly. Once I made sure the code could connect locally I moved on to trying to connect it to my hosting service. This was challenging, but I soon figured out that I needed to input the server’s information (i.e. password, host name, database name, etc.) into my config.php file.

After that, I realised my root directory could be seen on the web page, which was not ideal. I soon found that I needed to write a .htaccess file that was separate to the hosting service. I researched how to write a .htaccess file, but found my code did not work. So after more research and emailing for assistance, my tutor found that there needed to be separate code that redirected from my root directory to my index.php. 

I tried to create a functional login and registration form and database so that users could separate their data from other users by using a mix of coding knowledge I already had and an online walkthrough. I thought I might be able to get something to work, but I could not get it functioning in time.

I did not have a big focus on the design aspect of my site, but did find that my .css file had to be connected differently to the other .php files by putting it in <style> tags. 

I tried using Boostrap CSS, but found it wasn’t showing up on my site so I had to add some basic CSS code from a previous task that I had.

Hosting service:
The hosting service, InfinityFree, was not the best service, but was decent for a first try. It was quite limited in its resources and help, so I had to rely on outside forums and websites when it came to specific coding problems. I found it difficult to navigate, as things were in separate areas, making it hard to organise. The most frustrating thing I found was that code worked differently on my local server than it did on InfinityFree. I am not entirely sure why this was, but I found I had to alter code on the site to get it to work. 

Reflection
Overall, I am quite proud of what I achieved. Being my first time doing back-end web development, I found it to be quite a big learning curve. If I had more time I would have tried to get the login and register pages to work and focus on the style of the site. I would have also liked to add more to it, or at least done something slightly more complicated coding wise, but found it challenging enough to do the basic code. It is nowhere near perfect, but I think it is a decent try. 

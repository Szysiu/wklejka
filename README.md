# SHARING AND STORING CODE SNIPPETS AND TEXT PLATFORM


Pastebin-style tool that allows users to  paste any text or code, specify a nickname and title, and choose the syntax language for their entry. The platform records the exact date of submission and applies syntax highlighting to the code, automatically coloring the syntax based on the selected programming language for improved readability.

Made with: PHP, Symfony, Javascript, MYSQL, HTML, CSS, TWIG













How to run app using Docker: \
1.Clone this repo \
2.Go inside <kbd>.docker</kbd> directory \
3.Run <kbd>docker compose up -d</kbd> to start containers \
4.Go inside <kbd>wklejka-php</kbd> container using <kbd>docker exec -it wklejka-php bash</kbd> or use terminal in Docker Desktop \
5.Run <kbd>composer install</kbd> to install necessary dependencies \
6.Run <kbd>php bin/console doctrine:migrations:migrate</kbd> to create database structure 

Now you can open app at <kbd>http://localhost:8080</kbd>

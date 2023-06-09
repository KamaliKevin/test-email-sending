# IMPORTANT: Before testing
<p>1. Install the PHPMailer package using Composer. If you don't have Composer, follow the official guide:</p>
<a href="https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos" target="_blank">Linux / Unix / macOS</a><br>
<a href="https://getcomposer.org/doc/00-intro.md#installation-windows" target="_blank">Windows</a>

<p>2. After installing Composer, you should be able to run the following command in a <b>Bash</b> terminal:</p>
<pre>composer require phpmailer/phpmailer</pre>

<p>3. Once installed, require the <b>autoload.php</b> file inside the <b>vendor</b> folder to load the PHPMailer files. The following piece of code should be put in the file that loads all the necessary assets</p>
<pre>require '[REST_OF_PATH]/vendor/autoload.php';</pre>
<p><b>[REST_OF_PATH]</b> indicates the folders/files that are before the <b>vendor</b> folder, if any</p>

<p>Also, be aware that you may need to include PHPMailer classes, such as:</p>
<pre>
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
</pre>

<p>4. Remember to set as well the server settings for PHPMailer. <b>Always use a sandbox environment when developing</b>. Example of </p>

<p>4. The PHPMailer package should be available to use now in <b>any file</b> you want to use it</p>

# About this
<p>This is an email testing functionality that has a basic contact form with alerts regarding errors and successful operations. It has the following fields:</p>
<ul>
    <li>Username</li>
    <li>Email</li>
    <li>Message/Body</li>
    <li>Multiple input file</li>
</ul>

<p>
View: <b>index.php</b><br>
Controller: <b>process.php</b>
</p>

<p>If this form is filled without errors, it will <b>send a message to the email address provided in the PHPMailer code, along with the attached files</b></p>

<p><b>Please, check WELL the files if you are going to reorganize them and put them into another file structure!</b></p>

# License
This project uses the MIT License. You can find more information inside the "LICENSE.md" file.
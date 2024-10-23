<?php
//Template Name:contact

get_header(); //header call
?>
<h2>
<img src="echo get_template_directory_uri();/assets/images/contact-banner.jpg">
</h2>
<div>
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3533.624666986437!2d85.30643631112912!3d27.667081927166873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb182dd2b93dd5%3A0xd1c9f3ce20523d!2sCode%20Pixelz%20Media%20Pvt%20Ltd.!5e0!3m2!1sen!2snp!4v1729669840256!5m2!1sen!2snp"
        width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
</div>
<div class="container">
    <form>
        <label for="fname">First Name</label>
        <input type="text" id="fname" name="firstname" placeholder="Your name..">

        <label for="lname">Last Name</label>
        <input type="text" id="lname" name="lastname" placeholder="Your last name..">

        <label for="country">Country</label>
        <select id="country" name="country">
            <option value="australia">Australia</option>
            <option value="canada">Canada</option>
            <option value="usa">USA</option>
        </select>

        <label for="subject">Subject</label>
        <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

        <input type="submit" value="Submit">

    </form>
</div>

<?php
get_footer();//footer call
?>
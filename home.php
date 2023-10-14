<?php
session_start(); // Start the session

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $user_name = $_SESSION['user_name'];
    $user_profile = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : '';
} else {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="img/journey.png">
</head>

<body>
    <div class="navbar">
        <nav>
            <div>
                <a href="home.php" class="logo">
                    <img src="path-to-your-image" alt="logo img">
                    <h1>Logo Name</h1>
                </a>
            </div>
            <ul>
                <li><a href="#home" id="homeLink" class="active">Home</a></li>
                <li><a href="features.php">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contactus">Contact Us</a></li>
            </ul>
            <img src="<?php echo !empty($user_profile) ? $user_profile : 'img/default-profile.png'; ?>" class="user-profile" alt="Profile Picture" onclick="toggleMenu()">


            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info-box">
                        <div class="user-info">
                            <img src="<?php echo !empty($user_profile) ? $user_profile : 'img/default-profile.png'; ?>" class="user-profile" alt="Profile Picture">
                            <h3 class="user-name"><?php echo $user_name; ?></h3>
                        </div>
                        <hr>
                    </div>


                    <a href="#" class="sub-menu-link" onclick="showEditProfileForm()">
                        <img src="img/profile.png">
                        <p>Edit Profile</p>
                        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <div id="editProfileForm">
                        <img id="back_arrow_edit" src="img/left-arrow.png" onclick="hideEditProfileForm()" alt="Back Arrow">
                        <span>Edit Profile</span>
                        <img id="profilePreview" src="<?php echo !empty($user_profile) ? $user_profile : 'img/default-profile.png'; ?>" class="user-profile" alt="Profile Picture">
                        <form action="update_profile.php" method="post" enctype="multipart/form-data">
                            <div class="file-container">
                                <label for="file-input">Choose File</label>
                                <input type="file" id="file-input" name="profile_picture" accept="image/*" required onchange="previewImage(event)">
                                <input type="submit" value="Upload Profile" class="upload_profile">
                            </div>
                        </form>
                    </div>


                    <a href="#" class="sub-menu-link" onclick="showSettingsForm()">
                        <img src="img/setting.png">
                        <p>Settings & Privacy</p>
                        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <div id="SettingsForm">
                        <img id="back_arrow_settings" src="img/left-arrow.png" onclick="hideSettingsForm()" alt="Back Arrow">
                        <span>Settings & Privacy</span>
                    </div>

                    <a href="#" class="sub-menu-link" onclick="showHelpForm()">
                        <img src="img/help.png">
                        <p>Help & Support</p>
                        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <div id="HelpForm">
                        <img id="back_arrow_help" src="img/left-arrow.png" onclick="hideHelpForm()" alt="Back Arrow">
                        <span>Help & Support</span>
                    </div>

                    <a href="#" class="sub-menu-link" onclick="showNightModeForm()">
                        <img src="img/night-mode.png">
                        <p>Display & Accessibility</p>
                        <span class="chevron"><i class="fas fa-chevron-right"></i></span>
                    </a>

                    <div id="NightModeForm">
                        <img id="back_arrow_nightmode" src="img/left-arrow.png" onclick="hideNightModeForm()" alt="Back Arrow">
                        <span>Display & Accessibility</span>
                    </div>

                    <a href="#" class="sub-menu-link">
                        <img src="img/feedback.png">
                        <p>Give Feedback</p>
                        <span></span>
                    </a>

                    <a href="logout.php" class="sub-menu-link">
                        <img src="img/logout.png">
                        <p>Log out</p>
                        <span></span>
                    </a>

                </div>
            </div>
        </nav>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var homeLink = document.getElementById('homeLink');

            homeLink.addEventListener('click', function(e) {
                e.preventDefault();
            });
        });



        function toggleMenu() {
            var subMenu = document.getElementById("subMenu");
            subMenu.classList.toggle("open-menu");
            //subMenu.classList.toggle("close-menu");

        }

        document.addEventListener('click', function(event) {
            var subMenu = document.getElementById('subMenu');
            var userIcon = document.querySelector('.user-profile');
            var editProfileForm = document.getElementById("editProfileForm");
            var settingsForm = document.getElementById("SettingsForm");
            var helpForm = document.getElementById("HelpForm");
            var nightmodeForm = document.getElementById("NightModeForm");

            if (event.target !== subMenu && !subMenu.contains(event.target) && event.target !== userIcon) {
                subMenu.classList.remove('open-menu');
                editProfileForm.style.display = "none";
                settingsForm.style.display = "none";
                helpForm.style.display = "none";
                nightmodeForm.style.display = "none";
            }
        });

        function showEditProfileForm() {
            hideSettingsForm();
            hideHelpForm();
            hideNightModeForm();
            var editProfileForm = document.getElementById("editProfileForm");
            var subMenu = document.getElementById("subMenu");
            editProfileForm.style.display = "block";
            //subMenu.classList.remove('open-menu');
        }

        function hideEditProfileForm() {
            var editProfileForm = document.getElementById("editProfileForm");
            var subMenu = document.getElementById("subMenu");
            editProfileForm.style.display = "none";
            subMenu.classList.add('open-menu');
        }

        function showSettingsForm() {
            hideEditProfileForm();
            hideHelpForm();
            hideNightModeForm();
            var settingsForm = document.getElementById("SettingsForm");
            var subMenu = document.getElementById("subMenu");
            settingsForm.style.display = "block";
            //subMenu.classList.remove('open-menu');
        }

        function hideSettingsForm() {
            var settingsForm = document.getElementById("SettingsForm");
            settingsForm.style.display = "none";
        }

        function showHelpForm() {
            hideEditProfileForm();
            hideSettingsForm();
            hideNightModeForm();
            var helpForm = document.getElementById("HelpForm");
            var subMenu = document.getElementById("subMenu");
            helpForm.style.display = "block";
            //subMenu.classList.remove('open-menu');
        }

        function hideHelpForm() {
            var helpForm = document.getElementById("HelpForm");
            helpForm.style.display = "none";
        }

        function showNightModeForm() {
            hideEditProfileForm();
            hideSettingsForm();
            hideHelpForm();
            var nightmodeForm = document.getElementById("NightModeForm");
            var subMenu = document.getElementById("subMenu");
            nightmodeForm.style.display = "block";
            //subMenu.classList.remove('open-menu');
        }

        function hideNightModeForm() {
            var nightmodeForm = document.getElementById("NightModeForm");
            nightmodeForm.style.display = "none";
        }

        document.getElementById("back_arrow_edit").addEventListener("click", function() {
            var editProfileForm = document.getElementById("editProfileForm");
            var subMenu = document.getElementById("subMenu");
            editProfileForm.style.display = "none";
            subMenu.classList.add('open-menu');
        });

        document.getElementById("back_arrow_settings").addEventListener("click", function() {
            var settingsForm = document.getElementById("SettingsForm");
            var subMenu = document.getElementById("subMenu");
            settingsForm.style.display = "none";
            subMenu.classList.add('open-menu');
        });

        document.getElementById("back_arrow_help").addEventListener("click", function() {
            var helpForm = document.getElementById("HelpForm");
            var subMenu = document.getElementById("subMenu");
            helpForm.style.display = "none";
            subMenu.classList.add('open-menu');
        });

        document.getElementById("back_arrow_nightmode").addEventListener("click", function() {
            var nightmodeForm = document.getElementById("NightModeForm");
            var subMenu = document.getElementById("subMenu");
            nightmodeForm.style.display = "none";
            subMenu.classList.add('open-menu');
        });



        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('profilePreview');

            var reader = new FileReader();
            reader.onload = function() {
                preview.src = reader.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>

</html>
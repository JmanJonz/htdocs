<img src="/phpmotors/images/site/logo.png" alt="Logo Image">
<?php
if(isset($_SESSION["welcomeMessage"])){
    echo "<a href='/phpmotors/accounts/'>" . $_SESSION["welcomeMessage"] . "</a>";
}
?>

<?php
// If user is not logged in display the My Account link 
// If not display the logout link thing
if(isset($_SESSION["loggedin"])){
    if($_SESSION["loggedin"] != 1){
        echo '<a href="/phpmotors/accounts/index.php?action=login" title="Login or Create An Account">My Account</a>';
    } else{
        echo '<a href="/phpmotors/accounts/index.php?action=logout" title="Logout">Logout</a>';
    }
} else{
    echo '<a href="/phpmotors/accounts/index.php?action=login" title="Login or Create An Account">My Account</a>';

}
?>

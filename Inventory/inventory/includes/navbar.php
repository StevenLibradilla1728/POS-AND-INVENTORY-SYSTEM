



<style>
    .sb-topnav {
        margin-top: 4rem;
        height: 3rem;
        background: #00BD79;
    }

    .form-control {
        height: 1.8rem;
        margin-top: 3px;
    }

    .custom-swal-popup {
        width: 420px;
        height: 340px; 
        padding: 0.5rem;
        border-radius: 40px;
        font-size: 13px;
    }

    .dropdown-item:hover {
        background-color: #00BD79;
        color: white;
    }

    .sb-sidenav-toggled .sidebar {
    display: none; /* or use appropriate collapse/hide styles */
    }

    .sidebar {
    display: block; /* Ensure sidebar is visible by default */
    /* Add other default styles for sidebar */
    }
</style>
<nav class="sb-topnav navbar navbar-expand navbar-dark text-white rounded-0" style="margin-top:0px;">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="">
                <img src="./assets/img/trees-sp1.png" alt="Img" style="width: 120px;height: 35px; margin-top: 1px; margin-bottom: 2px;"/>
            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-0 my-0 my-md-0">
                <div class="input-group">
                    <!--<input class="form-control rounded-5" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-success rounded-5" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i><i class="fas fa-bars"></i></button>-->
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" style="text-decoration: none; background: transparent;" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="<?= $_SESSION['loggedInUser']['image']; ?>" alt="" style="width:34px;height:34px;border-radius:50%;margin-right:10px;">
                    <?= $_SESSION['loggedInUser']['name']; ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <!--<li><a class="dropdown-item" href="edit-profile.php">Update Profile</a></li>-->
                        <!--<li><hr class="dropdown-divider" /></li>-->
                        <li><button onclick="confirmLogout()" class="dropdown-item border-0">Logout</button></li>
                    </ul>
                </li>
            </ul>
        </nav>


        <script>
/*
window.addEventListener('DOMContentLoaded', event => {

// Default to hidden sidebar
if (!localStorage.getItem('sb|sidebar-toggle')) {
    localStorage.setItem('sb|sidebar-toggle', 'false');
}

if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
    document.body.classList.add('sb-sidenav-toggled');
} else {
    document.body.classList.remove('sb-sidenav-toggled');
}

// Toggle the side navigation
const sidebarToggle = document.body.querySelector('#sidebarToggle');
if (sidebarToggle) {
    sidebarToggle.addEventListener('click', event => {
        event.preventDefault();
        document.body.classList.toggle('sb-sidenav-toggled');
        localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
}
});*/



    function confirmLogout() {
        Swal.fire({
            title: 'Are you sure you want to logout?',
            text: "This action cannot be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            customClass: {
                popup: 'custom-swal-popup' // Add a custom class to the popup
            },
            showClass: {
                popup: 'animate__animated animate__fadeInDown'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutUp'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../logout.php";
            }
        });
    }
</script>

            <!-- Username and surname with drop down menu for login and admin panel  !-->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <?= $_SESSION['username']; ?> <?= $_SESSION['surname']; ?>
              </a>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                <li>
                  <a class="dropdown-item" href="functions/IsAdmin.php">Admin panelis</a>
                </li>
                <li>
                  <a class="dropdown-item" href="../logout.php">Izrakstīties</a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    </nav>
    <div id="menu-btn" class="fas fa-bars"></div>
  </header>
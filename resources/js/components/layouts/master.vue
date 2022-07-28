<template>
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light border-bottom">
            <div class="container-fluid">
                <router-link to="/" tag="a" class="navbar-brand">Resource Management</router-link>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item"><router-link to="/" tag="a" class="nav-link active">Home</router-link></li>
                        <li class="nav-item"><router-link to="/admin" tag="a" class="nav-link">Admin</router-link></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
    </main>

    <footer class="footer mt-auto py-3 bg-light border-top text-center">
        <div class="container-fluid">
            <span class="text-muted">&copy; Mohammad Shoriful Islam Ronju</span>
        </div>
    </footer>
</template>

<template>
    <footer class="main-footer shadow-top-lg shadow-neutral-800 grid grid-rows md:grid-cols-2 gap-4 px-8 py-3">
        <div class="container mx-auto flex flex-col md:flex-row  gap-3 justify-center items-center md:justify-start items-start md:col-start-1 md:col-end-3 md:grid-cols-2">
            <RouterLink to="/mentions-legales">Mentions légales</RouterLink>  <span class="hidden md:block">|</span>
            <RouterLink to="/politique-de-confidentialite">Politique de confidentialité</RouterLink> <span class="hidden md:block">|</span>
            <RouterLink to="/conditions-generales-d-utilisation">CGU</RouterLink> 
        </div>
        <p class="md:col-end-7 md:col-span-2">© 2023, SimpliCV. Tous droits réservés.</p>
    </footer>
</template>
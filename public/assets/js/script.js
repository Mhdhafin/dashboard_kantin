// Dark Mode functionality
const darkModeToggle = document.getElementById('dark-mode-toggle');
const html = document.documentElement;

// Check for saved theme preference or default to light mode
const currentTheme = localStorage.getItem('theme') || 'light';


if (currentTheme === 'dark') {
html.classList.add('dark');
}

darkModeToggle?.addEventListener('click', () => {
html.classList.toggle('dark');

// Save theme preference
const theme = html.classList.contains('dark') ? 'dark' : 'light';
localStorage.setItem('theme', theme);
});

// Profile dropdown functionality
function setupProfileDropdown(buttonId, dropdownId, chevronId) {
const button = document.getElementById(buttonId);
const dropdown = document.getElementById(dropdownId);
const chevron = document.getElementById(chevronId);

if (!button || !dropdown || !chevron) return;

button.addEventListener('click', (e) => {
e.stopPropagation();
const isVisible = !dropdown.classList.contains('opacity-0');

if (isVisible) {
dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
chevron.classList.remove('rotate-180');
} else {
dropdown.classList.remove('opacity-0', 'invisible', 'translate-y-2');
chevron.classList.add('rotate-180');
}
});

// Close dropdown when clicking outside
document.addEventListener('click', () => {
dropdown.classList.add('opacity-0', 'invisible', 'translate-y-2');
chevron.classList.remove('rotate-180');
});

// Prevent dropdown from closing when clicking inside it
dropdown.addEventListener('click', (e) => {
e.stopPropagation();
});
}

// Setup both desktop and mobile profile dropdowns
setupProfileDropdown('desktop-profile-button', 'desktop-profile-dropdown', 'desktop-profile-chevron');
setupProfileDropdown('mobile-profile-button', 'mobile-profile-dropdown', 'mobile-profile-chevron');

// Mobile menu functionality
const mobileMenuButton = document.getElementById('mobile-menu-button');
const mobileSidebar = document.getElementById('mobile-sidebar');
const sidebarBackdrop = document.getElementById('sidebar-backdrop');
const closeSidebar = document.getElementById('close-sidebar');

// Function to open mobile sidebar
function openMobileSidebar() {
mobileSidebar.classList.remove('-translate-x-full');
sidebarBackdrop.classList.remove('opacity-0', 'pointer-events-none');
sidebarBackdrop.classList.add('opacity-100');
document.body.classList.add('overflow-hidden');
}

// Function to close mobile sidebar
function closeMobileSidebar() {
mobileSidebar.classList.add('-translate-x-full');
sidebarBackdrop.classList.add('opacity-0', 'pointer-events-none');
sidebarBackdrop.classList.remove('opacity-100');
document.body.classList.remove('overflow-hidden');
}

// Event listeners
mobileMenuButton?.addEventListener('click', openMobileSidebar);
closeSidebar?.addEventListener('click', closeMobileSidebar);
sidebarBackdrop?.addEventListener('click', closeMobileSidebar);

// Close sidebar when clicking on menu items (optional)
const mobileMenuItems = document.querySelectorAll('.mobile-menu-item');
mobileMenuItems.forEach(item => {
item.addEventListener('click', closeMobileSidebar);
});

// Handle escape key
document.addEventListener('keydown', function(event) {
if (event.key === 'Escape') {
closeMobileSidebar();
}
});

function navigateWithTheme(url) {
// Save current theme before navigation
const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
localStorage.setItem('theme', currentTheme);

// Navigate
window.location.href = url;
}

if (window.matchMedia) {
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
// Only auto-switch if user hasn't manually set a preference
if (!localStorage.getItem('theme')) {
const newTheme = e.matches ? 'dark' : 'light';
document.documentElement.classList.toggle('dark', newTheme === 'dark');
}
});
}

   function previewImage() {
                const image = document.querySelector(".image");
                const file = document.querySelector(".file");
                const imgPreview = document.querySelector("#img-preview");

                // Menampilkan preview hanya jika file telah dipilih
                if (image.files && image.files[0]) {
                    imgPreview.style.display = "block";
                    file.style.display = "none";

                    const oFReader = new FileReader();
                    oFReader.readAsDataURL(image.files[0]);

                    oFReader.onload = function(oFREvent) {
                        imgPreview.src = oFREvent.target.result;
                    };
                }
            }



function toggleActionDropdown(id) {
  const actionButton = document.getElementById(id);
  if (!actionButton) return; // Jaga-jaga kalau ID tidak ditemukan

  actionButton.classList.toggle('opacity-0');
  actionButton.classList.toggle('invisible');
  actionButton.classList.toggle('translate-y-2');
}



 let fieldCount = 1;

document.getElementById("add-field").addEventListener("click", function () {
    const container = document.getElementById("dynamic-fields");
    const newField = document.createElement("div");

    newField.classList.add("sm:col-span-2", "flex", "items-center", "gap-5");
    newField.innerHTML = `
        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Produk <span class="text-red-500">*</span>
            </label>
            <select name="items[${fieldCount}][product_id]" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option class="hidden">Pilih Produk</option>
                ${document.getElementById("product-options").innerHTML}
            </select>
        </div>
        <div class="w-full">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Jumlah <span class="text-red-500">*</span>
            </label>
            <input type="number" name="items[${fieldCount}][quantity]" required min="1"
                class="block w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="0">
        </div>
    `;

    container.appendChild(newField);
    fieldCount++;
});


function togglePassword()
{
    var x = document.getElementById("password");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

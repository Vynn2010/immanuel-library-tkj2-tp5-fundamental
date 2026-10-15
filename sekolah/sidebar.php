<?php
$currentPage = basename($_SERVER['SCRIPT_NAME']);
$menuItems = [
  ['href' => 'index.php', 'label' => 'Dashboard'],
  ['href' => 'pembayaran.php', 'label' => 'Pembayaran'],
  ['href' => 'siswa.php', 'label' => 'Siswa'],
];
?>
<aside id="sidebar" class="fixed top-16 left-0 z-20 w-64 h-[calc(100vh-4rem)] transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-gray-200" aria-label="Sidebar">
  <div class="h-full px-3 py-4 overflow-y-auto">
    <ul class="space-y-2 font-medium">
      <?php foreach ($menuItems as $item): ?>
        <?php $active = $item['href'] === $currentPage; ?>
        <li>
          <a href="<?= htmlspecialchars($item['href']) ?>" class="flex items-center p-2 rounded-lg <?= $active ? 'bg-red-50 text-blue-700' : 'text-gray-900 hover:bg-gray-100' ?>">
            <span class="ms-3"><?= htmlspecialchars($item['label']) ?></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
  </div>
</aside>

<main class="flex-1 pt-16 sm:ml-64">
  <div class="p-6">

<!-- <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="text-heading bg-transparent box-border border border-transparent hover:bg-neutral-secondary-medium focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-base ms-3 mt-3 text-sm p-2 focus:outline-none inline-flex sm:hidden">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h10"/>
   </svg>
</button>

<aside id="default-sidebar" class="mt-15 fixed top-0 left-0 z-40 w-64 h-full transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-neutral-primary-soft border-e border-default">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="pembayaran.php" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
               <svg class="w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z"/><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z"/></svg>
               <span class="ms-3">Pembayaran</span>
            </a>
         </li>
         <li>
            <a href="siswa.php" class="flex items-center px-2 py-1.5 text-body rounded-base hover:bg-neutral-tertiary hover:text-fg-brand group">
               <svg class="shrink-0 w-5 h-5 transition duration-75 group-hover:text-fg-brand" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M16 19h4a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-2m-2.236-4a3 3 0 1 0 0-4M3 18v-1a3 3 0 0 1 3-3h4a3 3 0 0 1 3 3v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-10a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Siswa</span>
            </a>
         </li>
      </ul>
   </div>
</aside> -->

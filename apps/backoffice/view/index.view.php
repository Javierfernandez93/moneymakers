<style>
    :root {
        --bs-color-light: <?php echo $Academy->getConfig('color_light');?>;
        --bs-color-gray-20: rgba(0,0,0,0.2);
        --bs-color-gray-05: rgba(0,0,0,0.05);
        --bs-color-primary: <?php echo $Academy->getConfig('color_primary');?>;
    }
</style>

<div class="container-fluid py-4" id="app">
    <backoffice-viewer class="mb-5"></backoffice-viewer>
    <schedule-viewer></schedule-viewer>
</div>
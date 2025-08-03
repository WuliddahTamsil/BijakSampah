// Update Themes Manager
document.addEventListener('DOMContentLoaded', function() {
    // Wait for theme manager to be available
    function initializeThemeManager() {
        if (window.themeManager) {
            console.log('Theme manager is available, initializing...');
            
            // Listen for theme changes from settings
            window.addEventListener('themeChanged', (e) => {
                console.log('Theme change detected:', e.detail.theme);
                
                // Update theme manager
                if (window.themeManager && window.themeManager.setTheme) {
                    window.themeManager.setTheme(e.detail.theme);
                }
                
                // Update global settings
                const globalSettings = {
                    theme: e.detail.theme,
                    fontSize: e.detail.fontSize || 'medium'
                };
                
                if (window.globalTheme) {
                    window.globalTheme.updateSettings(globalSettings);
                }
            });
            
            // Listen for font size changes from settings
            window.addEventListener('fontSizeChanged', (e) => {
                console.log('Font size change detected:', e.detail.fontSize);
                
                // Update theme manager
                if (window.themeManager && window.themeManager.setFontSize) {
                    window.themeManager.setFontSize(e.detail.fontSize);
                }
                
                // Update global settings
                const globalSettings = {
                    theme: e.detail.theme || 'light',
                    fontSize: e.detail.fontSize
                };
                
                if (window.globalTheme) {
                    window.globalTheme.updateSettings(globalSettings);
                }
            });
            
            console.log('Theme manager integration complete');
        } else {
            console.log('Theme manager not available yet, retrying...');
            setTimeout(initializeThemeManager, 100);
        }
    }
    
    // Start initialization
    initializeThemeManager();
}); 
import preset from './vendor/filament/support/tailwind.config.preset'

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './vendor/awcodes/filament-curator/resources/**/*.blade.php',
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        screens: {
            'sm': '640px',
            'md': '768px',
            'lg': '1024px',
            'xl': '1280px',
            '2xl': '1536px',
        },
        extend: {
            fontFamily: {
                "mulish": ['Mulish', 'sans-serif']
            },
            colors: {
                transparent: "transparent",
                current: "currentColor",
                "fe-primary": 'rgb(168, 85, 247)',
                "fe-secondary": 'rgb(107, 114, 128)',
                "fe-info": 'rgb(14, 165, 233)',
            },
        },
        container: {
            center: true,
        },

    },
}

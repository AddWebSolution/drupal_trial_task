module.exports = {
	content: ["./src/**/*.css", "./**/*.html"],
	theme: {
		extend: {
			container: {
				center: true,
				padding: '15px',
				screens: {
					sm: '640px',
					md: '960px',
					lg: '1024px',
					xl: '1280px',
					'2xl': '1536px',
				},
			},

			transitionDuration: {
				3000: '3000ms',
			},

			fontFamily: {
				inter: ['Inter', 'sans-serif'],
			},
			boxShadow: {
				'pro-card': ['0px 1px 3px rgba(0, 0, 0, 0.1), 0px 1px 2px rgba(0, 0, 0, 0.06)'],
			},

			maxWidth: {
				'card-width': '344px',
				'wimg': '128px',

			},
			minWidth: {
				'mwimg': '128px',
			},
			maxHeight: {
				'himg': '128px',
			},
			minHeight: {
				'proinfo': '298px',
				'mhimg': '128px',
			},
			padding: {
				'pro-info': '17px 0 16px 0',
			}
		},
	},
};
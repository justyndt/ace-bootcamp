import Plyr from 'plyr';

const sjgcPlyr = {
	init() {
		const embededVideo = document.querySelectorAll(
			'.wp-block-embed__wrapper'
		);

		embededVideo.forEach((player) => {
			new Plyr(player, {
				ratio: '16:9',
			});
		});
	},
};

export default sjgcPlyr;

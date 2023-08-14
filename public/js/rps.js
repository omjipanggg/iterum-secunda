let moves = 3;
let botScore = 0;
let playerScore = 0;
const game = (props) => {
	const textBotScore = document.querySelector('#botScore');
	const textPlayerScore = document.querySelector('#playerScore');
	const canvas = document.querySelector('#handContainer');
	const move = document.querySelector('#moveLeft');
	const nextScore = document.querySelector('#nextScore');
	const result = document.querySelector('#result');
	const restart = document.querySelector('#restart');
	const botHand = document.querySelector('#botHand');
	const playerHand = document.querySelector('#playerHand');

	const playGame = () => {
		moves--;
		const ai = Math.floor(Math.random()*3);
		const aiHands = ['✊', '✋', '✌'];
		const bot = aiHands[ai];

		move.innerText = moves;
		judgeTime(props, bot);

		result.innerText = props + ' vs ' + bot;

		botHand.innerText = bot;
		playerHand.innerText = props;

		if (moves === 0) {
			gameOver();
		}
	}

	const judgeTime = (player, bot) => {
		if (player === bot) {
			nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = Seri";
		}
		else if (player === '✊') {
			if (bot === '✋') {
				nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = SELENA menang!";
				botScore++;
				textBotScore.textContent = botScore;
			} else {
				nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = Kamu menang!";
				playerScore++;
				textPlayerScore.textContent = playerScore;
			}
		}
		else if (player === '✋') {
			if (bot === '✌') {
				nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = SELENA menang!";
				botScore++;
				textBotScore.textContent = botScore;
			} else {
				nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = Kamu menang!";
				playerScore++;
				textPlayerScore.textContent = playerScore;
			}
		}
		else if (player === '✌') {
			if (bot === '✊') {
				nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = SELENA menang!";
				botScore++;
				textBotScore.textContent = botScore;
			} else {
				nextScore.textContent = 'kamu (' + player + '), ' + "selena (" + bot + ") = Kamu menang!";
				playerScore++;
				textPlayerScore.textContent = playerScore;
			}
		}
	}

	const gameOver = () => {
		canvas.classList.add('d-none');
		restart.classList.remove('d-none');
		nextScore.classList.add('d-none');
		let say = 'Silakan coba lagi.';
		if (playerScore > botScore) {
			say = 'Selamat, kamu menang!';
		} else if (playerScore < botScore) {
			say = 'SELENA menang!';
		} else {
			say = 'Seri.';
		}
		result.classList.remove('d-none');
		result.textContent = say;
		result.style.fontWeight = '500';
		result.style.backgroundColor = 'var(--primary-bright-color)';
		result.style.border = '1px solid var(--primary-color)';
		result.style.padding = '0 1rem';
		result.style.color = 'var(--primary-color)';
	}
	playGame();
}
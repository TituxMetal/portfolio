<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<title>Guillaume LANG | Développeur / Intégrateur Web et Administrateur système Linux</title>
  <link href="/assets/css/app.min.css" rel="stylesheet">
</head>

<body>
	
	<header class="home__header">
		<section class="header__hook">
			<h1>
				Guillaume LANG
			</h1>
			<p>
				Développeur / Intégrateur Web
			</p>
			<p>
				Administrateur Système Linux
			</p>
		</section>
	</header>
	<section class="navigation__overlay">
		<div class="navigation__hamburger--icon">
			<span></span>
		</div>
		<nav class="navigation__menu">
			<ul class="navigation__menu--items">
				<li>
					<a href="#skills" title="Les compétences et outils de Guillaume LANG">Compétences</a>
				</li>
				<li>
					<a href="#profile" title="Le profil de Guillaume LANG">Profil</a>
				</li>
				<li>
					<a href="#projects" title="Les projets réalisés par Guillaume LANG">Projets</a>
				</li>
				<li>
					<a href="#contact" title="Contactez Guillaume LANG">Contact</a>
				</li>
			</ul>
		</nav>
	</section>
	
	<section class="box__wrap skills" id="skills">
		<article>
			<h2  title="Les compétences de Guillaume LANG">Compétences</h2>
			<ul class="knowledge">
        <?php foreach($knowledges as $knowledge): ?>
          <li><?= $knowledge->title(); ?></li>
        <?php endforeach; ?>
			</ul>
		</article>
		<article>
			<h2 title="Les technologies et outils utilisés par Guillaume LANG">Technologies</h2>
			<ul class="tech">
				<li>
					<figure>
						<img src="/assets/img/tech/html5_logo.png" alt="Html5"/>
						<figcaption>
							Html5
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/css3_logo.png" alt="Css3"/>
						<figcaption>
							Css3
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/javascript_logo.png" alt="Javascript"/>
						<figcaption>
							Javascript
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/php_logo.png" alt="Php"/>
						<figcaption>
							Php
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/mariadb_logo.png" alt="MariaDb"/>
						<figcaption>
							MariaDb
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/sass_logo.png" alt="Sass"/>
						<figcaption>
							Sass
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/atom_logo.png" alt="Atom"/>
						<figcaption>
							Atom
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/git_logo.png" alt="Git"/>
						<figcaption>
							Git
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/composer_logo.png" alt="Composer"/>
						<figcaption>
							Composer
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/gulp_logo.png" alt="Gulp"/>
						<figcaption>
							Gulp
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/docker_logo.png" alt="Docker"/>
						<figcaption>
							Docker
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/ansible_logo.png" alt="Ansible"/>
						<figcaption>
							Ansible
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/jquery_logo.png" alt="jQuery"/>
						<figcaption>
							jQuery
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/bootstrap_logo.png" alt="Bootstrap"/>
						<figcaption>
							Bootstrap
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/foundation_logo.png" alt="Foundation"/>
						<figcaption>
							Foundation
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/laravel_logo.png" alt="Laravel"/>
						<figcaption>
							Laravel
						</figcaption>
					</figure>
				</li>
				<li>
					<figure>
						<img src="/assets/img/tech/symfony_logo.png" alt="Symfony"/>
						<figcaption>
							Symfony
						</figcaption>
					</figure>
				</li>
			</ul>
		</article>
	</section>
	<section class="bg__profile profile" id="profile">
		<article class="profile__about">
			<h2 title="Le profil de Guillaume LANG">Profil</h2>
			<p>
				<strong class="lead">Guillaume LANG en quelques mots.</strong>
				J'ai le soucis du détail, je m'investis à fond dans ce que je fait, honnête et dévoué, toujours entrain d'apprendre et découvrir de nouvelles choses, je sais me remettre en question, j'apprends de mes erreurs.
			</p>
		</article>
		<article class="profile__training">
			<h2 title="Le parcours de Guillaume LANG">Formations</h2>
			<p>
				En 1995, j'ai obtenu un <strong>B.E.P Structures Métalliques</strong> au Lycée du bâtiment de Cernay. En 2002, j'ai obtenu le <strong>CCP Cariste</strong>, puis en 2013 j'ai passé les <strong>CACES Cariste 1, 3 et 5</strong>.
			</p>
			<p>
				Passionné autodidacte depuis plus de 10 ans, j'ai appris à créer mes premiers sites Web grâce à <a href="http://openclassrooms.com" title="OpenClassRooms" target="_blank">OpenClassRooms</a> et <a href="http://grafikart.fr" title="Grafikart" target="_blank">Grafikart</a>.
			</p>
			<p>
				En 2016, j'ai décidé de me reconvertir aux métiers du Web en suivant la formation intensive de <strong>Développeur / Intégrateur Web</strong> à la <a href="http://3wa.fr" title="3WAcademy" target="_blank">3WAcademy</a> de Strasbourg.
			</p>
		</article>
	</section>
	<section class="box__wrap projects" id="projects">
		<article class="portfolio__projects">
			<h2 title="Les projets réalisés par Guillaume LANG">Projets réalisés</h2>
			<ul>
				<li>
					<article class="project">
						<h2 class="lead">
							<a href="http://tenchido.fr" title="Karaté Tenchido Obernai" target="_blank" class="underline">Tenchido Obernai</a>
						</h2>
						<p class="project__description">
							Refonte design du site du club de karaté d'Obernai. J'avais carte blanche pour créer le design, en gardant les couleurs principales du club et le logo. J'ai réalisé l'intégration Html, Css et Javascript dans la structure Php existante. J'ai choisi de réaliser le style en utilisant le préprocesseur Sass, sans aucun framework.
						</p>
						<figure class="project__img">
							<img src="/assets/img/projects/projectsTenchido.jpg" alt="Site du Tenchido d'Orbernai">
						</figure>
						<footer class="project__link">
							<ul>
								<li>
									<a href="https://web.archive.org/web/20161028195201/http://www.tenchido.fr/" title="Karaté Tenchido Obernai avant la refonte" target="_blank" class="underline">
										<i class="fa fa-globe" aria-hidden="true"></i>
										Le projet avant
									</a>
								</li>
								<li>
									<a href="http://tenchido.fr" title="Karaté Tenchido Obernai" target="_blank" class="underline">
										<i class="fa fa-globe" aria-hidden="true"></i>
										Le projet après
									</a>
								</li>
							</ul>
						</footer>
					</article>
				</li>
				<li>
					<article class="project">
						<h2 class="lead">
							<a href="http://albinweyer.fr" target="_blank" title="Page de bienvenue du jeune Albin" class="underline">Bienvenue Albin</a>
						</h2>
						<p class="project__description">
							Une page de présentation pour la naissance du fils à un ami. Page réalisée en Html, Css et Javascript. J'ai réalisé le style en utilisant le préprocesseur Sass, sans aucun framework. J'ai réalisé le diaporama en Javascript ES6.
						</p>
						<figure class="project__img">
							<img src="/assets/img/projects/projectsAlbin.jpg" alt="Application de prise de notes">
						</figure>
						<footer class="project__link">
							<ul>
								<li>
									<a href="http://albinweyer.fr" target="_blank" title="Page de bienvenue du jeune Albin"  class="underline">
										<i class="fa fa-globe" aria-hidden="true"></i>
										Voir le projet
									</a>
								</li>
								<li>
									<a href="https://github.com/TituxMetal/welcomAlbin" target="_blank" title="Code source de la page de bienvenue du jeune Albin" class="underline">
										<i class="fa fa-github" aria-hidden="true"></i>
										Voir les sources
									</a>
								</li>
							</ul>
						</footer>
					</article>
				</li>
				<li>
					<article class="project">
						<h2 class="lead">
							<a href="http://tictactoe.lg-ed.com" target="_blank" title="Jeu du Tic Tac Toe" class="underline">Jeu du Tic Tac Toe</a>
						</h2>
						<p class="project__description">
							Petite application du jeu du Tic Tac Toe faite en javascript pendant ma formation à la 3WAcademy. J'ai récement fait quelques modifications au niveau du style et des couleurs.
						</p>
						<figure class="project__img">
							<img src="/assets/img/projects/projectsTicTacToe.jpg" alt="Jeu du Tic Tac Toe">
						</figure>
						<footer class="project__link">
							<ul>
								<li>
									<a href="http://tictactoe.lg-ed.com" target="_blank" title="Jeu du Tic Tac Toe" class="underline">
										<i class="fa fa-globe" aria-hidden="true"></i>
										Voir le projet
									</a>
								</li>
								<li>
									<a href="https://github.com/TituxMetal/ticTacToe" target="_blank" title="Code source du jeu du TicTacToe" class="underline">
										<i class="fa fa-github" aria-hidden="true"></i>
										Voir les sources
									</a>
								</li>
							</ul>
						</footer>
					</article>
				</li>
				<li>
					<article class="project">
						<h2 class="lead">
							<a href="http://notes.lg-ed.com" target="_blank" title="Application de prise de notes" class="underline">App de prise de notes</a>
						</h2>
						<p class="project__description">
							Une application de prise de notes, réalisée en suivant une série de vidéos sur <a href="https://www.codecourse.com/lessons/vuex-notes-app" target="_blank" title="Créer une application de prise de note avec VueJs et Vuex">CodeCourse.com</a> qui montre comment utiliser VueJs et Vuex.
						</p>
						<figure class="project__img">
							<img src="/assets/img/projects/porjectsNotesapp.jpg" alt="Application de prise de notes">
						</figure>
						<footer class="project__link">
							<ul>
								<li>
									<a href="http://notes.lg-ed.com" target="_blank" title="Application de prise de notes" class="underline">
										<i class="fa fa-globe" aria-hidden="true"></i>
										Voir le projet
									</a>
								</li>
								<li>
									<a href="https://github.com/TituxMetal/vuejsNotes" target="_blank" title="Code source de l'pplication de prise de notes" class="underline">
										<i class="fa fa-github" aria-hidden="true"></i>
										Voir les sources
									</a>
								</li>
							</ul>
						</footer>
					</article>
				</li>
			</ul>
		</article>
	</section>
	<section class="bg__contact contact" id="contact">
		<article>
			<h2 title="Contactez Guillaume LANG">Contactez-moi</h2>
			<form action="#" class="contact__form">
				<div class="contact__form--field">
					<label for="contactName" class="form__field--label">
						Votre nom
					</label>
					<input type="text" id="contactName" name="contactName" class="form__field--input">
				</div>
				<div class="contact__form--field">
					<label for="contactEmail" class="form__field--label">
						Votre email
					</label>
					<input type="email" id="contactEmail" name="contactEmail" class="form__field--input">
				</div>
				<div class="contact__form--field">
					<label for="contactSubject" class="form__field--label">
						Sujet
					</label>
					<input type="text" id="contactSubject" name="contactSubject" class="form__field--input">
				</div>
				<div class="contact__form--field">
					<label for="contactMessage" class="form__field--label">
						Votre message
					</label>
					<textarea name="contactMessage" id="contactMessage" class="form__field--textarea"></textarea>
				</div>
				<div class="contact__form--button">
					<button type="submit" value="send" title="Envoyez un message à Guillaume LANG">
						Envoyer
					</button>
				</div>
			</form>
		</article>
	</section>
	
	<footer class="box__wrap footer">
		<h3 title="Guillaume LANG, développeur / Intégrateur Web et Administrateur système Linux" class="footer__title">
			Guillaume LANG
		</h3>
		<section class="footer__resume">
			<ul class="footer__resume--list">
				<li>Création de sites Web</li>
				<li>Développement front-end</li>
				<li>Responsive Web Design</li>
				<li>Administration de serveur Linux</li>
				<li>Optimisation Seo</li>
			</ul>
		</section>
		<section class="footer__links">
			<ul class="footer__links--list">
				<li>
					<a href="https://portfolio.lg-ed.com" title="Accueil du portfolio de Guillaume LANG">Accueil du site</a>
				</li>
				<li>
					<a href="https://github.com/TituxMetal" title="Compte GitHub de Guillaume LANG" target="_blank">Compte GitHub</a>
				</li>
				<li>
					<a href="https://gitlab.com/TituxMetal" title="Compte GitLab de Guillaume LANG" target="_blank">Compte GitLab</a>
				</li>
			</ul>
		</section>
		<section class="footer__foot">
			<span>Created with love and lots of coffee</span>
			<span>by Guillaume LANG</span>
			<span><a href="https://github.com/TituxMetal/portfolio" target="_blank">Voir le code source</a></span>
		</section>
	</footer>

  <script src="/assets/js/app.min.js"></script>
</body>

</html>

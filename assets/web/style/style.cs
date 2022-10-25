/* ALL CONFIGS */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Montserrat", sans-serif;
  overflow-x: hidden;
}

:root {
  font-size: 62.5%;
}

/* COLORS */
/* GREEN-200 */
/* GRAY-100 */
/* GRAY-500 */
/* GRAY-800 */
/* FONT SIZE */
/* MARGINs AND PADDINGS */
/* NAVIGATION */
nav#navigation {
  overflow: hidden;
  max-width: 100vw;
  height: 6rem;
  background-color: blue;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}
nav#navigation a {
  width: 15rem;
  display: flex;
  justify-content: center;
  padding: 0.5rem 1rem;
  text-decoration: none;
  font-size: 2rem;
  font-weight: 500;
  color: #f3f4f6;
  transition: 0.5s ease;
}

@media (min-width: 992px) {
  nav#navigation {
    height: 8rem;
  }
  nav#navigation a:hover {
    border-bottom: 1px solid white;
    color: #bbf7d0;
  }
}
/* SLIDER */
.carousel {
  display: none;
}

.content-text {
  position: absolute;
  right: 15%;
  bottom: 5%;
  left: 15%;
  padding-top: 1.25rem;
  padding-bottom: 1.25rem;
  color: #f3f4f6;
  text-align: center;
}

.carousel-inner {
  max-width: 100vw;
  max-height: 100vh;
}

.carousel-item img {
  max-width: 100%;
  max-height: 80vh;
  background-size: cover;
  background-position: center;
}
.carousel-item h1 {
  font-size: 2.8rem;
  font-weight: 500;
  text-transform: uppercase;
  padding-bottom: 1.5rem;
}
.carousel-item p {
  padding-bottom: 1rem;
  font-size: 2rem;
}
.carousel-item a {
  background-color: rgba(0, 0, 0, 0.15);
  text-decoration: none;
  border-radius: 1rem;
  border: none;
  outline: none;
  font-size: 2.8rem;
  margin-bottom: 2rem;
  padding-inline: 1.5rem;
  color: #f3f4f6;
  transition: 0.5s;
}
.carousel-item a:hover {
  color: #bbf7d0;
  outline: none;
  border: none;
  border-bottom: 2px solid #bbf7d0;
}

@media (min-width: 992px) {
  /* MOBILE SLIDER */
  .carousel {
    display: block;
  }
}
/* CARDS */
section#ourProducts {
  margin-top: 4rem;
  width: 100vw;
  height: auto;
  display: flex;
  align-items: center;
  flex-direction: column;
}
section#ourProducts h1 {
  font-size: 2.8rem;
  font-weight: 700;
  text-transform: uppercase;
  color: #6b7280;
  padding: 0 1rem;
  margin-bottom: 4rem;
}
section#ourProducts .products {
  grid-template-columns: 1fr;
  grid-template-rows: 5fr 4fr;
  grid-template-areas: "box01" "box02";
}
section#ourProducts .resources {
  grid-template-columns: 1fr;
  grid-template-rows: 1fr 2fr;
  grid-template-areas: "box01" "box02";
}
section#ourProducts .container-box {
  width: 95vw;
  height: 80rem;
  display: grid;
}
section#ourProducts .container-box .box {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-direction: column;
}
section#ourProducts .container-box .box .content {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
section#ourProducts .container-box .box .content h2 {
  font-size: 2rem;
  font-weight: 700;
  text-transform: uppercase;
  color: #6b7280;
  padding: 0.5rem;
}
section#ourProducts .container-box .box .content p {
  font-size: 1.6rem;
  font-weight: 400;
  color: #1f2937;
  padding: 0 1rem;
}
section#ourProducts .container-box .box .content a {
  display: none;
}
section#ourProducts .container-box .box01 {
  grid-area: box01;
}
section#ourProducts .container-box .box01 img {
  width: 100%;
  height: 100%;
}
section#ourProducts .container-box .box02 {
  grid-area: box02;
}
@media (min-width: 600px) {
  section#ourProducts .container-box {
    height: 50rem;
  }
}
@media (min-width: 750px) {
  section#ourProducts section#ourProducts h1 {
    font-size: 2.8rem;
  }
  section#ourProducts .products {
    grid-template-columns: 2fr 3fr;
    grid-template-rows: 1fr;
    grid-template-areas: "box01 box02";
  }
  section#ourProducts .resources {
    grid-template-columns: 4fr 2fr;
    grid-template-rows: 1fr;
    grid-template-areas: "box02 box01";
  }
  section#ourProducts .container-box {
    width: 90vw;
    margin-bottom: 3rem;
  }
  section#ourProducts .container-box .box .content p {
    padding: 0rem 5rem;
  }
  section#ourProducts .container-box .box .content a {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 0.5rem 1rem;
    width: 20rem;
    height: 4rem;
    font-size: 2rem;
    font-weight: 500;
    text-decoration: none;
    border: none;
    outline: none;
    border-radius: 1rem;
    background-color: #d1d5db;
    color: #6b7280;
    transition: 0.5s ease;
  }
  section#ourProducts .container-box .box .content a:hover {
    background-color: transparent;
    border: 1px solid #d1d5db;
    font-weight: 700;
    overflow: hidden;
  }
}

/* WHYSHOLDUSE */
section#whyShouldUse {
  width: 100vw;
  height: auto;
  display: flex;
  align-items: center;
  flex-direction: column;
}
section#whyShouldUse h1 {
  font-size: 2.8rem;
  font-weight: 700;
  text-transform: uppercase;
  color: #6b7280;
}
section#whyShouldUse .container-box {
  width: 90%;
  height: auto;
  display: grid;
  grid-template-columns: 1fr;
  grid-template-rows: 1fr 1fr;
  grid-template-areas: "box01" "box02";
}
section#whyShouldUse .container-box .box {
  min-height: 20rem;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-top: 3rem;
}
section#whyShouldUse .container-box .box h3 {
  font-size: 2rem;
  font-weight: 500;
  padding: 0.5rem 1rem;
  color: #6b7280;
}
section#whyShouldUse .container-box .box .line {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
  padding: 0.5rem 1rem;
}
section#whyShouldUse .container-box .box .line svg {
  width: 4rem;
  height: 4rem;
}
section#whyShouldUse .container-box .box .line path[stroke*=black] {
  stroke: #16a34a;
}
section#whyShouldUse .container-box .box .line span {
  font-size: 1.6rem;
  font-weight: 500;
  color: #16a34a;
}
section#whyShouldUse .container-box .safety {
  grid-area: box01;
}
section#whyShouldUse .container-box .connectivity {
  grid-area: box02;
}
@media (min-width: 750px) {
  section#whyShouldUse .container-box {
    grid-template-columns: 1fr 1fr;
    grid-template-rows: 1fr;
    grid-template-areas: "box01 box02";
  }
  section#whyShouldUse .connectivity {
    margin-left: 3rem;
  }
}

/* FAQ */
section#faq {
  max-width: 100vw;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-top: 4rem;
}
section#faq h1 {
  font-size: 2.8rem;
  font-weight: 700;
  color: #6b7280;
}
section#faq .content {
  height: 100%;
  display: grid;
  grid-template-columns: 1fr;
  gap: 3.2rem;
  margin-top: 3rem;
}
section#faq .card {
  width: 90vw;
  min-height: 20rem;
  margin: 0 auto;
  display: flex;
  justify-content: space-evenly;
  align-items: flex-start;
  padding: 1.2rem 1rem;
  background-color: #f3f4f6;
}
section#faq .card h1 {
  font-size: 2rem;
  font-weight: 700;
  color: #1f2937;
}
section#faq .card p {
  text-align: justify;
  font-size: 1.6rem;
  font-weight: 500;
  color: #4d7c0f;
}

@media (min-width: 750px) {
  section#faq .content {
    grid-template-columns: 1fr 1fr;
  }
  section#faq .card {
    width: 40vw;
  }
}
@media (min-width: 992px) {
  section#faq .content {
    grid-template-columns: 1fr 1fr 1fr;
  }
  section#faq .card {
    width: 30vw;
  }
}
/* FORM FAQ */
section#formFaq {
  width: 90vw;
  height: auto;
  margin: 0 auto;
  margin-top: 4rem;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  background-color: #f3f4f6;
  border-radius: 1rem;
  padding-block: 2rem;
}
section#formFaq h1 {
  font-size: 2.8rem;
  font-weight: 700;
  color: #6b7280;
  padding-top: 1rem;
}
section#formFaq form {
  width: 80%;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
}
section#formFaq form .line {
  width: 90%;
  height: auto;
  display: flex;
  justify-content: center;
  flex-direction: column;
  padding: 0.5rem 1.2rem;
}
section#formFaq form .line label {
  font-size: 1.6rem;
  font-weight: 700;
  padding-block: 0.5rem;
}
section#formFaq form .line input {
  width: 100%;
  height: 2.4rem;
  border: none;
  border-bottom: 1px solid black;
  font-size: 1.6rem;
  color: #6b7280;
  background-color: transparent;
}
section#formFaq form .line input:focus {
  outline: none;
}
section#formFaq form button {
  width: 75%;
  height: 4rem;
  outline: none;
  border: none;
  border-radius: 1rem;
  font-size: 2rem;
  font-weight: 700;
  margin-top: 2rem;
  background-color: #d1d5db;
  color: #6b7280;
  transition: 0.5s ease;
}

@media (min-width: 992px) {
  section#formFaq {
    width: 75vw;
  }
  section#formFaq form button:hover {
    background-color: transparent;
    border: 1px solid #6b7280;
    border-radius: 1rem;
  }
}
/* FOOTER */
footer#footer {
  width: 100vw;
  height: auto;
  margin-top: 4rem;
  display: grid;
  grid-template-columns: 1fr;
  background-color: blue;
}
footer#footer .box {
  width: 100%;
  min-height: 10rem;
  margin: 0 auto;
  display: flex;
  justify-content: center;
  align-items: center;
}
footer#footer .box ul {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 1rem;
}
footer#footer .box ul li {
  transition: 0.5s ease;
}
footer#footer .box ul li svg {
  width: 4rem;
  height: 4rem;
}
footer#footer .box ul li path[stroke] {
  stroke: white;
}
footer#footer .box ul li path[fill] {
  fill: white;
}

@media (min-width: 750px) {
  footer#footer {
    grid-template-columns: 1fr 1fr;
  }
  footer#footer .box {
    height: 15rem;
  }
  footer#footer .box ul li svg {
    width: 4.5rem;
    height: 4.5rem;
  }
  footer#footer .box ul li:hover path[stroke] {
    stroke: #bbf7d0;
  }
  footer#footer .box ul li:hover path[fill] {
    fill: #bbf7d0;
  }
}
/* LOGIN */
section#login {
  width: 100vw;
  height: 100vh;
  background-color: blue;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
}
section#login .content {
  width: 80%;
  height: 90%;
  background-color: white;
  display: flex;
  align-items: center;
  flex-direction: column;
  border-radius: 1rem;
}
section#login .content header {
  width: 100%;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-top: 3rem;
}
section#login .content header h1 {
  font-size: 2rem;
  font-weight: 700;
  padding: 1.2rem 0.4rem;
  text-transform: uppercase;
  color: #6b7280;
}
section#login .content form {
  width: 100%;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  margin-top: 3rem;
}
section#login .content form .line {
  width: 90%;
  height: auto;
  display: flex;
  justify-content: center;
  flex-direction: column;
}
section#login .content form .line label {
  font-size: 2rem;
  font-weight: 700;
  padding-block: 0.8rem;
}
section#login .content form .line input {
  height: 3.2rem;
  border: none;
  outline: none;
  border-bottom: 1px solid black;
  color: #6b7280;
  padding: 0.4rem;
  font-size: 1.6rem;
}
section#login .content form button {
  width: 75%;
  height: 4rem;
  outline: none;
  border: none;
  border-radius: 1rem;
  font-size: 2rem;
  font-weight: 700;
  text-transform: uppercase;
  margin-top: 2rem;
  background-color: #d1d5db;
  color: #6b7280;
  transition: 0.5s ease;
}
section#login .content form .data-error {
  width: 50%;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-block: 1.2rem;
}
section#login .content form .data-error p {
  font-size: 1.2rem;
  font-weight: 700;
  color: red;
}
section#login .content form .not-acount {
  width: 90%;
  height: auto;
  display: flex;
  justify-content: center;
  align-items: center;
}
section#login .content form .not-acount p {
  font-size: 1.6rem;
  font-weight: 500;
  color: #4d7c0f;
}
section#login .content form .not-acount a {
  text-decoration: none;
  color: #4d7c0f;
  transition: 0.5s ease;
}

@media (min-width: 750px) {
  section#login .content {
    width: 75%;
    height: 60%;
  }
  section#login .content form .line {
    width: 75%;
  }
  section#login .content form button {
    width: 30%;
  }
  section#login .content form .data-error p {
    font-size: 1.6rem;
  }
}
@media (min-width: 992px) {
  section#login {
    width: 100vw;
  }
  section#login .content {
    width: 40%;
    height: 100%;
  }
  section#login .content form .line {
    width: 75%;
  }
  section#login .content form button {
    width: 30%;
  }
  section#login .content form button:hover {
    background-color: transparent;
    border: 1px solid #6b7280;
    border-radius: 1rem;
  }
  section#login .content form .not-acount a:hover {
    color: #6b7280;
    font-weight: 700;
  }
}
.message.warning {
  color: var(--primary-color);
}

.message.error {
  color: red;
}

.message.success {
  color: lightblue;
}

/*# sourceMappingURL=style.cs.map */

// adding a class depend on the avertissement type to add somme style from avertissement.css
let avertissementText = document.getElementById("avertissementText");
if (
  avertissementText.innerText === "Mise en garde 1" ||
  avertissementText.innerText === "Mise en garde 2" ||
  avertissementText.innerText === "Avertissement 1" ||
  avertissementText.innerText === "Avertissement 2"
) {
  avertissementText.classList.add("avertissement");
} else if (
  avertissementText.innerText === "Exclusion de 2 j (1)" ||
  avertissementText.innerText === "Exclusion de 2 j (2)" ||
  avertissementText.innerText === "Exclusion temporaire" ||
  avertissementText.innerText === "Exclusion définitive"
) {
  avertissementText.classList.add("exclusion");
} else if (avertissementText.innerText === "Blame") {
  avertissementText.classList.add("blame");
}

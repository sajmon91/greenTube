const tagNameBg = document.querySelector(".tagName");

if (tagNameBg) {
  const color = randomRGBA();
  tagNameBg.style.backgroundColor = color;
}

function randomRGBA() {
  const o = Math.round;
  const r = Math.random;
  const s = 255;
  return `rgba(${o(r() * s)}, ${o(r() * s)}, ${o(r() * s)}, 0.2)`;
}

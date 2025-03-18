import axios from 'axios';
import gsap from 'gsap';

import { Draggable } from "gsap/Draggable";
import { Flip } from "gsap/Flip";
// Implementación nativa de la funcionalidad de InertiaPlugin
gsap.registerPlugin({
  name: "inertia",
  init(target, value) {
    this.target = target;
    this.value = value;
  },
  render(progress) {
    const inertia = this.value * (1 - progress);
    this.t.style.transform = `translate(${inertia}px, ${inertia}px)`;
  },
  track(progress) {
    const inertia = this.value * (1 - progress);
    progress.style.transform = `translate(${inertia}px, ${inertia}px)`;
  }
});


window.gsap = gsap;
window.Draggable = Draggable;
window.Flip = Flip;

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

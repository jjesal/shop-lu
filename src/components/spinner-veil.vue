<template>
  <div class="envolve">
    <div class="lds-ring">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
</template>

<script>
export default {
  name: "spinnerVeil"
};
</script>

<style scoped>
.envolve {
  /* my own */
  display: flex;
  justify-self: center;
  justify-content: center;
  align-items: center;
  width: 100%;
  /* height: 100%; */
  margin: auto;
  position: absolute;
  height: 100vh;
  width: 100vw;
}
.lds-ring {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
  /* my own */
  display: flex;
  justify-self: center;
  align-self: center;
  margin: auto
}
.lds-ring div {
  box-sizing: border-box;
  display: block;
  position: absolute;
  width: 51px;
  height: 51px;
  margin: 6px;
  border: 6px solid #fff;
  border-radius: 50%;
  animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  border-color: var(--loading-color-2) transparent transparent transparent;
}
.lds-ring div:nth-child(1) {
  animation-delay: -0.45s;
}
.lds-ring div:nth-child(2) {
  animation-delay: -0.3s;
}
.lds-ring div:nth-child(3) {
  animation-delay: -0.15s;
}
@keyframes lds-ring {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
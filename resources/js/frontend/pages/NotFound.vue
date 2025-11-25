<script setup>
const props = defineProps({
  initialState: {
    type: Object,
    default: () => ({})
  }
})
</script>

<template>
  <section class="min-h-screen flex items-center justify-center bg-gradient-to-b from-[#0b0f19] via-[#080c16] to-[#020409] relative overflow-hidden pt-24">

    <!-- Space starfield -->
    <svg class="absolute inset-0 w-full h-full pointer-events-none" xmlns="http://www.w3.org/2000/svg">
      <g opacity="0.7">
        <circle cx="8%" cy="18%" r="1" fill="#fff"><animate attributeName="opacity" values="0.5;1;0.5" dur="3s" repeatCount="indefinite"/></circle>
        <circle cx="22%" cy="42%" r="1" fill="#fff"><animate attributeName="opacity" values="0.6;1;0.6" dur="2.6s" repeatCount="indefinite"/></circle>
        <circle cx="38%" cy="12%" r="1" fill="#fff"><animate attributeName="opacity" values="0.4;1;0.4" dur="3.4s" repeatCount="indefinite"/></circle>
        <circle cx="54%" cy="28%" r="1" fill="#fff"><animate attributeName="opacity" values="0.7;1;0.7" dur="2.8s" repeatCount="indefinite"/></circle>
        <circle cx="66%" cy="10%" r="1" fill="#fff"><animate attributeName="opacity" values="0.5;1;0.5" dur="2.2s" repeatCount="indefinite"/></circle>
        <circle cx="74%" cy="46%" r="1" fill="#fff"><animate attributeName="opacity" values="0.6;1;0.6" dur="3.1s" repeatCount="indefinite"/></circle>
        <circle cx="12%" cy="72%" r="1" fill="#fff"><animate attributeName="opacity" values="0.5;1;0.5" dur="2.5s" repeatCount="indefinite"/></circle>
        <circle cx="32%" cy="84%" r="1" fill="#fff"><animate attributeName="opacity" values="0.6;1;0.6" dur="2.9s" repeatCount="indefinite"/></circle>
        <circle cx="58%" cy="78%" r="1" fill="#fff"><animate attributeName="opacity" values="0.4;1;0.4" dur="3.6s" repeatCount="indefinite"/></circle>
        <circle cx="86%" cy="64%" r="1" fill="#fff"><animate attributeName="opacity" values="0.7;1;0.7" dur="2.7s" repeatCount="indefinite"/></circle>
      </g>
      <defs>
        <linearGradient id="nebula" x1="0" y1="0" x2="1" y2="1">
          <stop offset="0%" stop-color="#4f46e5"/>
          <stop offset="50%" stop-color="#9333ea"/>
          <stop offset="100%" stop-color="#ec4899"/>
        </linearGradient>
      </defs>
      <ellipse cx="78%" cy="85%" rx="220" ry="60" fill="url(#nebula)" opacity="0.12">
        <animate attributeName="rx" values="200;230;200" dur="10s" repeatCount="indefinite"/>
      </ellipse>
    </svg>

    <!-- Planet with ring -->
    <div class="planet"></div>

    <!-- Rocket -->
    <svg class="rocket" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg">
      <g>
        <path d="M32 4 C38 8 44 20 44 32 C44 44 38 56 32 60 C26 56 20 44 20 32 C20 20 26 8 32 4 Z" fill="#e2e8f0"/>
        <circle cx="32" cy="24" r="6" fill="#60a5fa"/>
        <path d="M20 32 L12 36 L20 40" fill="#ef4444"/>
        <path d="M44 32 L52 36 L44 40" fill="#ef4444"/>
      </g>
      <g class="exhaust">
        <polygon points="30,48 34,48 32,58" fill="#f59e0b"/>
      </g>
    </svg>

    <!-- Content -->
    <div class="text-center px-6 relative z-10 select-none">
      <h1 class="text-8xl font-extrabold tracking-wide bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 bg-clip-text text-transparent">404</h1>
      <p class="mt-4 text-gray-300 text-lg animate-fadeIn">Lost in Space — page not found.</p>
      <div class="mx-auto mt-6 w-48 h-1 bg-gradient-to-r from-blue-400 via-purple-500 to-pink-500 rounded-full animate-glow"></div>
      <div class="mt-10">
        <router-link to="/" class="px-7 py-3 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium transition">
          Back to Home
        </router-link>
      </div>
    </div>
  </section>
</template>

<style>
@keyframes glowPulse {
  0% { opacity: 0.3; filter: blur(2px); }
  50% { opacity: 1; filter: blur(4px); }
  100% { opacity: 0.3; filter: blur(2px); }
}
.animate-glow { animation: glowPulse 3s ease-in-out infinite; }

@keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
.animate-fadeIn { animation: fadeIn 1.2s ease forwards; }

@keyframes rocketFloat {
  0% { transform: translateY(0) rotate(-2deg); }
  50% { transform: translateY(-10px) rotate(2deg); }
  100% { transform: translateY(0) rotate(-2deg); }
}
.rocket { position: absolute; right: 3rem; top: 35%; width: 96px; height: 96px; filter: drop-shadow(0 8px 24px rgba(59,130,246,0.35)); animation: rocketFloat 6s ease-in-out infinite; }

@keyframes exhaustPulse {
  0% { opacity: 0.6; transform: translateY(0) scale(1); }
  50% { opacity: 1; transform: translateY(3px) scale(1.1); }
  100% { opacity: 0.6; transform: translateY(0) scale(1); }
}
.exhaust { animation: exhaustPulse 0.8s ease-in-out infinite; }

.planet { position: absolute; left: -6rem; bottom: 2.5rem; width: 16rem; height: 16rem; border-radius: 9999px; background: radial-gradient(circle at 30% 30%, #0ea5e9 0%, #1e3a8a 40%, #0b0f19 70%); box-shadow: 0 0 60px rgba(14,165,233,0.25); }
.planet::after { content: ""; position: absolute; left: 50%; top: 50%; transform: translate(-50%, -50%) rotate(-20deg); width: 19rem; height: 8rem; border-radius: 50%; border: 2px solid rgba(255,255,255,0.12); }
</style>

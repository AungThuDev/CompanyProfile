<template>
  <section id="contact" class="py-32 bg-gradient-to-b from-gray-900 to-black relative overflow-hidden">
    <!-- Background grid -->
    <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,.02)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,.02)_1px,transparent_1px)] bg-[size:100px_100px]" />

    <div class="max-w-7xl mx-auto px-6 relative">
      <!-- Section header -->
      <div ref="headerRef" class="text-center mb-16">
        <h2 class="text-white mb-4">Let's Work Together</h2>
        <p class="text-gray-400 max-w-2xl mx-auto">
          Have a project in mind? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
        </p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Contact Info + Socials -->
        <div ref="infoRef" class="space-y-8">
          <!-- Contact Info -->
          <div>
            <h3 class="text-white mb-6">Get In Touch</h3>
            <div class="space-y-6">
              <div
                v-for="(item, index) in contactInfo"
                :key="item.label"
                ref="el => contactRefs[index] = el"
                class="flex items-start gap-4"
              >
                <div class="p-3 rounded-lg bg-gradient-to-br from-blue-500/20 to-purple-500/20 border border-white/10">
                  <component :is="item.icon" class="w-5 h-5 text-blue-400" />
                </div>
                <div>
                  <div class="text-sm text-gray-400 mb-1">{{ item.label }}</div>
                  <div class="text-white">{{ item.value }}</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Social Links -->
          <div>
            <h3 class="text-white mb-4">Follow Us</h3>
            <div class="flex gap-4">
              <div
                v-for="social in socialLinks"
                :key="social.id"
                ref="el => socialRefs.push(el)"
                class="p-3 rounded-lg bg-white/5 border border-white/10 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all duration-300"
              >
                <a :href="social.href" target="_blank" rel="noopener noreferrer">
                  <component :is="social.icon" class="w-5 h-5 text-gray-400 hover:text-blue-400" />
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- Contact Form -->
        <div ref="formRef" class="lg:col-span-2">
          <form @submit.prevent="handleSubmit" class="space-y-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
              <div>
                <label for="name" class="block text-sm text-gray-400 mb-2">Your Name</label>
                <input
                  type="text"
                  id="name"
                  name="name"
                  v-model="formData.name"
                  placeholder="John Doe"
                  required
                  class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-300"
                />
              </div>
              <div>
                <label for="email" class="block text-sm text-gray-400 mb-2">Email Address</label>
                <input
                  type="email"
                  id="email"
                  name="email"
                  v-model="formData.email"
                  placeholder="john@example.com"
                  required
                  class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-300"
                />
              </div>
            </div>

            <div>
              <label for="subject" class="block text-sm text-gray-400 mb-2">Subject</label>
              <input
                type="text"
                id="subject"
                name="subject"
                v-model="formData.subject"
                placeholder="Project Inquiry"
                required
                class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-300"
              />
            </div>

            <div>
              <label for="message" class="block text-sm text-gray-400 mb-2">Message</label>
              <textarea
                id="message"
                name="message"
                rows="6"
                v-model="formData.message"
                placeholder="Tell us about your project..."
                required
                class="w-full px-4 py-3 rounded-lg bg-white/5 border border-white/10 text-white placeholder-gray-500 focus:border-blue-500/50 focus:outline-none focus:ring-2 focus:ring-blue-500/20 transition-all duration-300 resize-none"
              ></textarea>
            </div>

            <button
              type="submit"
              ref="submitRef"
              class="w-full px-8 py-4 bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg text-white hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] transition-all duration-300 flex items-center justify-center gap-2 group"
            >
              Send Message
              <component :is="Icons.Send" class="group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform duration-300" />
            </button>
          </form>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import { useMotion } from '@vueuse/motion'
import * as Icons from 'lucide-vue-next'

const props = defineProps({
  contactInfo: {
    type: Object,
    default: () => ({})
  },
  socialLinks: {
    type: Array,
    default: () => []
  },
})

/* -----------------------------------
   CONTACT INFO (Dynamic Lucide Icons)
------------------------------------*/
const contactInfo = [
  {
    icon: Icons.Mail,
    label: 'Email',
    value: props.contactInfo.email,
  },
  {
    icon: Icons.Phone,
    label: 'Phone',
    value: props.contactInfo.phone,
  },
  {
    icon: Icons.MapPin,
    label: 'Location',
    value: props.contactInfo.address,
  },
]

/* -----------------------------------
   SOCIAL LINKS (Dynamic icon mapping)
   Backend sends: name = "github"
------------------------------------*/
const socialLinks = props.socialLinks.map((social) => {
    const toPascal = (str) =>
    str
        .split(" ")
        .map(w => w.charAt(0).toUpperCase() + w.slice(1).toLowerCase())
        .join("");
    const iconComponent = Icons[toPascal(social.name)] || Icons.HelpCircle;

  return {
    id: social.id,
    icon: iconComponent,
    href: social.account_link,
    label: social.name,
  }
})

/* ------------------------------
   FORM DATA
-------------------------------*/
const formData = reactive({
  name: '',
  email: '',
  subject: '',
  message: '',
})

const handleSubmit = () => {
  console.log('Form submitted:', formData)

  formData.name = ''
  formData.email = ''
  formData.subject = ''
  formData.message = ''
}

/* ------------------------------
   ANIMATIONS
-------------------------------*/
const headerRef = ref(null)
const infoRef = ref(null)
const contactRefs = ref([])
const socialRefs = ref([])
const formRef = ref(null)
const submitRef = ref(null)

onMounted(() => {
  if (headerRef.value) {
    useMotion(headerRef.value, {
      initial: { opacity: 0, y: 30 },
      enter: { opacity: 1, y: 0 },
      transition: { duration: 0.6 },
    })
  }

  contactRefs.value.forEach((el, i) => {
    if (el) {
      useMotion(el, {
        initial: { opacity: 0, y: 20 },
        enter: { opacity: 1, y: 0 },
        transition: { duration: 0.5, delay: i * 0.1 },
      })
    }
  })

  socialRefs.value.forEach((el) => {
    if (el) {
      useMotion(el, {
        initial: { opacity: 0, y: 10 },
        enter: { opacity: 1, y: 0 },
        whileHover: { scale: 1.1 },
        whileTap: { scale: 0.95 },
        transition: { duration: 0.3 },
      })
    }
  })

  if (formRef.value) {
    useMotion(formRef.value, {
      initial: { opacity: 0, x: 50 },
      enter: { opacity: 1, x: 0 },
      transition: { duration: 0.8 },
    })
  }

  if (submitRef.value) {
    useMotion(submitRef.value, {
      whileHover: { scale: 1.02 },
      whileTap: { scale: 0.98 },
      transition: { duration: 0.2 },
    })
  }
})
</script>


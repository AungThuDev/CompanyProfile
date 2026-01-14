import { onMounted, onBeforeUnmount, isRef } from 'vue'
import { useMotion } from '@vueuse/motion'

export const useInViewMotion = (elRef, config, observerOpts = {}) => {
  let observer

  const observe = (target) => {
    if (!target) return
    const { initial } = config || {}
    if (initial) {
      const t = []
      if (initial.x != null) t.push(`translateX(${initial.x}px)`)
      if (initial.y != null) t.push(`translateY(${initial.y}px)`)
      if (t.length) target.style.transform = t.join(' ')
      if (initial.opacity != null) target.style.opacity = String(initial.opacity)
    }

    const opts = { root: null, rootMargin: '0px', threshold: 0.2, once: true, ...observerOpts }

    observer = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          useMotion(target, config)
          if (opts.once && observer) observer.unobserve(target)
        }
      })
    }, { root: opts.root, rootMargin: opts.rootMargin, threshold: opts.threshold })

    observer.observe(target)
  }

  const isElement = (v) => v && v.nodeType === 1
  const isRefLike = (v) => v && typeof v === 'object' && 'value' in v

  let target = null
  if (isRefLike(elRef)) {
    if (isElement(elRef.value)) target = elRef.value
  } else if (isElement(elRef)) {
    target = elRef
  }

  if (target) {
    observe(target)
  } else if (isRef(elRef)) {
    onMounted(() => observe(elRef.value))
  }

  onBeforeUnmount(() => observer && observer.disconnect())
}

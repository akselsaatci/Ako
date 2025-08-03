// Theme toggle functionality
function initTheme() {
  const theme = localStorage.getItem("theme") || "light"
  document.documentElement.classList.toggle("dark", theme === "dark")
}

function toggleTheme() {
  const isDark = document.documentElement.classList.contains("dark")
  const newTheme = isDark ? "light" : "dark"

  document.documentElement.classList.toggle("dark", newTheme === "dark")
  localStorage.setItem("theme", newTheme)
}

// Mobile menu functionality
function initMobileMenu() {
  const mobileMenuToggle = document.getElementById("mobile-menu-toggle")
  const mobileMenu = document.getElementById("mobile-menu")
  const menuIcon = document.getElementById("menu-icon")
  const closeIcon = document.getElementById("close-icon")
  const mobileMenuLinks = document.querySelectorAll(".mobile-menu-link")

  mobileMenuToggle.addEventListener("click", () => {
    const isOpen = !mobileMenu.classList.contains("hidden")

    mobileMenu.classList.toggle("hidden", isOpen)
    menuIcon.classList.toggle("hidden", !isOpen)
    closeIcon.classList.toggle("hidden", isOpen)
  })

  // Close mobile menu when clicking on links
  mobileMenuLinks.forEach((link) => {
    link.addEventListener("click", () => {
      mobileMenu.classList.add("hidden")
      menuIcon.classList.remove("hidden")
      closeIcon.classList.add("hidden")
    })
  })
}

// Header scroll effect
function initHeaderScroll() {
  const header = document.getElementById("header")

  window.addEventListener("scroll", () => {
    if (window.scrollY > 10) {
      header.classList.add("scrolled")
    } else {
      header.classList.remove("scrolled")
    }
  })
}

// Pricing tabs functionality
function initPricingTabs() {
  const monthlyTab = document.getElementById("monthly-tab")
  const annuallyTab = document.getElementById("annually-tab")
  const monthlyPricing = document.getElementById("monthly-pricing")
  const annuallyPricing = document.getElementById("annually-pricing")

  monthlyTab.addEventListener("click", () => {
    monthlyTab.classList.add("active")
    annuallyTab.classList.remove("active")
    monthlyPricing.classList.remove("hidden")
    annuallyPricing.classList.add("hidden")
  })

  annuallyTab.addEventListener("click", () => {
    annuallyTab.classList.add("active")
    monthlyTab.classList.remove("active")
    annuallyPricing.classList.remove("hidden")
    monthlyPricing.classList.add("hidden")
  })
}

// FAQ accordion functionality
function initFAQ() {
  const faqTriggers = document.querySelectorAll(".faq-trigger")

  faqTriggers.forEach((trigger) => {
    trigger.addEventListener("click", () => {
      const content = trigger.nextElementSibling
      const isOpen = content.classList.contains("open")

      // Close all other FAQ items
      faqTriggers.forEach((otherTrigger) => {
        if (otherTrigger !== trigger) {
          otherTrigger.setAttribute("aria-expanded", "false")
          otherTrigger.nextElementSibling.classList.remove("open")
        }
      })

      // Toggle current FAQ item
      trigger.setAttribute("aria-expanded", !isOpen)
      content.classList.toggle("open", !isOpen)
    })
  })
}

// Scroll animations
function initScrollAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  }

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("visible")
      }
    })
  }, observerOptions)

  document.querySelectorAll(".fade-in-on-scroll").forEach((el) => {
    observer.observe(el)
  })
}

// Smooth scrolling for anchor links
function initSmoothScrolling() {
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })
}

// Initialize all functionality when DOM is loaded
document.addEventListener("DOMContentLoaded", () => {
  initTheme()
  initMobileMenu()
  initHeaderScroll()
  initPricingTabs()
  initFAQ()
  initScrollAnimations()
  initSmoothScrolling()

  // Theme toggle event listeners
  document.getElementById("theme-toggle").addEventListener("click", toggleTheme)
  document.getElementById("theme-toggle-mobile").addEventListener("click", toggleTheme)
})


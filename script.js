(() => {
  const header = document.querySelector(".site-header");
  const toggle = document.querySelector(".nav-toggle");
  const navLinks = document.querySelector("#nav-links");
  const form = document.querySelector("#contact-form");
  const status = document.querySelector("#form-status");

  const onScroll = () => {
    if (!header) return;
    header.classList.toggle("is-scrolled", window.scrollY > 12);
  };

  onScroll();
  window.addEventListener("scroll", onScroll, { passive: true });

  if (toggle && navLinks) {
    const setOpen = (open) => {
      toggle.setAttribute("aria-expanded", String(open));
      navLinks.classList.toggle("is-open", open);
      toggle.setAttribute("aria-label", open ? "بستن منو" : "باز کردن منو");
    };

    toggle.addEventListener("click", () => {
      const open = toggle.getAttribute("aria-expanded") !== "true";
      setOpen(open);
    });

    navLinks.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => setOpen(false));
    });
  }

  if (form && status) {
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      if (!form.checkValidity()) {
        form.reportValidity();
        status.textContent = "لطفاً فیلدهای ضروری را کامل کنید.";
        return;
      }
      status.textContent = "درخواست شما ثبت شد. به‌زودی با شما تماس می‌گیریم.";
      form.reset();
    });
  }

  const motionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
  if (!motionQuery.matches && "IntersectionObserver" in window) {
    const items = document.querySelectorAll(".curriculum-row, .faculty-item");
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) return;
          entry.target.classList.add("is-in");
          observer.unobserve(entry.target);
        });
      },
      { threshold: 0.18, rootMargin: "0px 0px -8% 0px" }
    );
    items.forEach((item, index) => {
      item.style.animationDelay = `${index % 3 * 0.08}s`;
      observer.observe(item);
    });
  }
})();

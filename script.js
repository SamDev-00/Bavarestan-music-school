(() => {
  const header = document.querySelector(".site-header");
  const toggle = document.querySelector(".nav-toggle");
  const navLinks = document.querySelector("#nav-links");
  const form = document.querySelector("#register-form");
  const status = document.querySelector("#form-status");
  const teacherSelect = document.querySelector("#teacher");
  const registerButtons = document.querySelectorAll(".register-btn");

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
      setOpen(toggle.getAttribute("aria-expanded") !== "true");
    });
    navLinks.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => setOpen(false));
    });
  }

  // Pick an instructor -> preselect in the registration form and scroll to it
  const highlightSelected = (value) => {
    registerButtons.forEach((btn) => {
      btn.classList.toggle("is-selected", btn.dataset.teacher === value);
    });
  };

  registerButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      const value = btn.dataset.teacher;
      if (teacherSelect) {
        teacherSelect.value = value;
        highlightSelected(value);
      }
      const target = document.querySelector("#register");
      if (target) target.scrollIntoView({ behavior: "smooth", block: "start" });
      const nameField = document.querySelector("#name");
      if (nameField) {
        window.setTimeout(() => nameField.focus({ preventScroll: true }), 500);
      }
    });
  });

  if (teacherSelect) {
    teacherSelect.addEventListener("change", () => highlightSelected(teacherSelect.value));
  }

  if (form && status) {
    form.addEventListener("submit", (event) => {
      event.preventDefault();
      if (!form.checkValidity()) {
        form.reportValidity();
        status.textContent = "لطفاً استاد، نام و شماره تماس را کامل کنید.";
        return;
      }
      const selected = teacherSelect && teacherSelect.selectedOptions.length
        ? teacherSelect.selectedOptions[0].textContent.trim()
        : "";
      status.textContent = selected
        ? `درخواست ثبت‌نام شما برای «${selected}» ثبت شد. به‌زودی تماس می‌گیریم.`
        : "درخواست شما ثبت شد. به‌زودی با شما تماس می‌گیریم.";
      form.reset();
      highlightSelected("");
    });
  }
})();

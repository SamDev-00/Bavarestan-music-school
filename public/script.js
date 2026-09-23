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
  const slotGroups = document.querySelectorAll("[data-slot-group]");
  const slotHint = document.querySelector("[data-slot-hint]");

  // Map each instructor's slug to their name/photo so we can preview them.
  const teacherMeta = {};
  registerButtons.forEach((btn) => {
    teacherMeta[btn.dataset.teacher] = {
      name: btn.dataset.teacherName || "",
      photo: btn.dataset.teacherPhoto || "",
    };
  });

  const preview = document.querySelector("[data-teacher-preview]");
  const previewAvatar = document.querySelector("[data-teacher-preview-avatar]");
  const previewName = document.querySelector("[data-teacher-preview-name]");

  const showPreviewFor = (value) => {
    if (!preview) return;
    const meta = teacherMeta[value];
    if (!value || !meta) {
      preview.hidden = true;
      return;
    }
    if (previewName) previewName.textContent = meta.name;
    if (previewAvatar) {
      if (meta.photo) {
        previewAvatar.innerHTML = "";
        previewAvatar.classList.remove("is-fallback");
        const img = document.createElement("img");
        img.src = meta.photo;
        img.alt = "عکس " + meta.name;
        img.loading = "lazy";
        previewAvatar.appendChild(img);
      } else {
        previewAvatar.classList.add("is-fallback");
        previewAvatar.textContent = meta.name ? meta.name.charAt(0) : "?";
      }
    }
    preview.hidden = false;
  };

  const highlightSelected = (value) => {
    registerButtons.forEach((btn) => {
      btn.classList.toggle("is-selected", btn.dataset.teacher === value);
    });
  };

  // Show only the chosen instructor's half-hour slots, and clear a slot that
  // was picked for a different instructor so it can't be submitted by mistake.
  const showSlotsFor = (value) => {
    let shown = false;

    slotGroups.forEach((group) => {
      const matches = group.dataset.slotGroup === value;
      group.hidden = !matches;

      if (matches) {
        shown = true;
      } else {
        group.querySelectorAll("input[name='slot']:checked").forEach((input) => {
          input.checked = false;
        });
      }
    });

    if (slotHint) slotHint.hidden = shown;
  };

  const selectTeacher = (value) => {
    if (teacherSelect) teacherSelect.value = value;
    highlightSelected(value);
    showSlotsFor(value);
    showPreviewFor(value);
  };

  registerButtons.forEach((btn) => {
    btn.addEventListener("click", () => {
      selectTeacher(btn.dataset.teacher);
      const target = document.querySelector("#register");
      if (target) target.scrollIntoView({ behavior: "smooth", block: "start" });
    });
  });

  if (teacherSelect) {
    teacherSelect.addEventListener("change", () => selectTeacher(teacherSelect.value));
    // Restore the picker when a validation error bounced the form back.
    if (teacherSelect.value) {
      showSlotsFor(teacherSelect.value);
      showPreviewFor(teacherSelect.value);
    }
  }

  if (form && status) {
    form.addEventListener("submit", (event) => {
      // The radio group can't be marked required in HTML, so check it here.
      if (!form.querySelector("input[name='slot']:checked")) {
        event.preventDefault();
        status.textContent = "لطفاً یکی از ساعت‌های خالی را انتخاب کنید.";
        const visible = document.querySelector("[data-slot-group]:not([hidden])");
        (visible || form).scrollIntoView({ behavior: "smooth", block: "center" });
        return;
      }
      status.textContent = "در حال ثبت درخواست...";
    });
  }
})();

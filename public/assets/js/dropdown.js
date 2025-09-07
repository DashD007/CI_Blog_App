// reusable update function
  function setupMultiSelect(containerId) {
    function updateSelected() {
      const container = $(containerId);
      container.empty();
      const checked = container.closest(".dropdown").find("input:checked");

      if (checked.length === 0) {
        container.append(`
              <div class="px-3 w-100" style="display: flex; justify-content: space-between; align-items: center;">
                <span class="text-muted">Select options...</span>
                <span class="text-muted" style="font-size: 24px;">˅</span>
              </div>`);
      } else {
        checked.each(function () {
          const chip = $(
            `<span class="chip">${this.id} <span class="remove">&times;</span></span>`
          );
          chip.find(".remove").click(() => {
            $(this).prop("checked", false).trigger("change");
          });
          container.append(chip);
        });
      }
    }
    $(containerId)
      .closest(".dropdown")
      .find("input[type=checkbox]")
      .change(updateSelected);
  }

  // Initialize for 5 dropdowns
  setupMultiSelect(".users-permissions");
  setupMultiSelect(".roles-permissions");
  setupMultiSelect(".categories-permissions");
  setupMultiSelect(".blogs-permissions");
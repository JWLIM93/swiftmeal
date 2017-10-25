const select = new mdc.select.MDCSelect(document.querySelector('.mdc-select'));
select.listen('MDCSelect:change', () => {
  alert(`Selected "${select.selectedOptions[0].textContent}" at index ${select.selectedIndex} ` +
    `with value "${select.value}"`);
});
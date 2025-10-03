<script>
  	import { tick, onMount } from 'svelte';

	export let mask;
	export let value;
	export let inputClass;
	export let placeholderText = '';
	let inputElement;

	function maskValue(value) {
		let masked = ''
		let i = makeDigiter(value);
		if (! i.more) {
			return masked;
		}

	for (const m of mask) {
			if (m === '9' && i.next()) {
				// consume digit
				masked += i.value;
			} else if (i.more) {
				// use mask character
				masked += m;
			} else {
				// ran out of digits
				break;
			}
		}
		return masked;
	}

	function makeDigiter(value) {
	const digits = getDigits(value);
		const { length } = digits;
		let i = 0;

		return {
			more: (i < length),
			value: null,
			next() {
				if (this.more) {
					this.value = digits[i];
					i += 1;
					this.more = i < length;
					return true;
				} else {
					return false;
				}
			}
		};
	}

	function getDigits(value) {
	let digits = '';
		for (const c of value) {
			if (c >= '0' && c <= '9') {
				digits += c;
			}
		}
	return digits;
	}

	function handleInput({ target: input, inputType}) {
		const {
			selectionStart: oldStart,
			selectionEnd: oldEnd,
			value: { length: oldLength }
		} = input;
	let [start, end] = [oldStart, oldEnd];

	value = fixIt(input, value, maskValue(input.value));
		
		const { length } = value;
	switch (inputType) {
		case 'insertText':
				const adjust = length - oldLength;
				if (adjust > 0) {
			start += adjust;
			} else if (isRightOfMask(start)) {
					start += 1;
				} 
		break;

		case 'deleteContentBackward':
		if(isRightOfMask(start)) {
					// Immediately to the right of non-digit
					// character, move to right of next digit
					// to the left. 
					// (TODO: more than one adjacent mask character)
			start -= 1;
		}
		break;

		case 'deleteContentForward':
		if (start === length && isRightOfMask(start)) {
					// End of content, immediately to the right of non-digit
					// character, move to right of last digit 
					// (TODO: more than one adjacent mask character)
			start -= 1;
		}
		break;
	}

	if (oldStart === oldEnd) {
		end = start;
	}
	queueRestoreSelection(input, start, end);
	}

	async function queueRestoreSelection(input, start, end) {
		await tick();
		input.setSelectionRange(start, end);
	}
		
	function isRightOfMask(position) {
		return  position > 1 && mask[position - 1] !== '9';
	}
		
	function fixIt(input, state, sanitized) {
		if (state === sanitized && sanitized !== input.value) {
			// Because 'SvelteDOMSetProperty' isn't fired
			input.value = sanitized;
		}
	return sanitized;
	}

	$: {
		if (inputElement) {
		const maskedValue = maskValue(value);
		inputElement.value = maskedValue;
		}
	}

	onMount(async () => {
		await tick();
		inputElement = document.querySelector('input');
		// const maskedValue = maskValue(value);
		// inputElement.value = maskedValue;
	});
</script>

<input
  maxLength={mask.length}
  on:input={handleInput}
  placeholder={placeholderText}
  value={value}
  class={inputClass}
/>
function graphSemiCircle(percentage){
    var bar = new ProgressBar.SemiCircle(container, {
        strokeWidth: 6,
        color: '#FFEA82',
        trailColor: '#eee',
        trailWidth: 1,
        easing: 'easeInOut',
        duration: 3000,
        svgStyle: null,
        text: {
            value: '',
            alignToBottom: false
        },
        from: {color: '#6a994e'},
        to: {color: '#ED6A5A'},
        // Set default step function for all animate calls
        step: (state, bar) => {
            bar.path.setAttribute('stroke', state.color);
            var value = Math.round(bar.value() * 100);
            bar.setText(value + ' %');
            bar.text.style.color = state.color;
        }
    });
    bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
    bar.text.style.fontSize = '2rem';

    bar.animate(percentage);
}
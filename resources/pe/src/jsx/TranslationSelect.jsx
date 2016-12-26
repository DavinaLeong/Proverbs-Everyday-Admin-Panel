var TranslationSelect = React.createClass({
    render: function () {
        var selectOptions = this.props.translations.map(function(option, index) {
            return (
                <option id={'abbr_' + (index+1)} value={option.abbr} key={'abbr_' + option.translation_id}>{option.name + ' (' + option.abbr + ')'}</option>
            );
        }.bind(this));


        return (
            <div className="form-group">
                <select className="form-control" id="abbr" name="abbr" required>
                    <option id="abbr_0" value="">-- Select Translation ---</option>
                    {selectOptions}
                </select>
            </div>
        );
    }
});
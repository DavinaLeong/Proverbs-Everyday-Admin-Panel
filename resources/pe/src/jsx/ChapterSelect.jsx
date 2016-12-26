var ChapterSelect = React.createClass({
    render: function () {
        var selectOptions = [];
        for (var i = 1; i <= 31; ++i)
        {
            selectOptions.push(<option id={'chapter_no_' + i} value={i} key={'chapter_no_' + i}>{i}</option>);
        }

        return (
            <div className="form-group">
                <select className="form-control" id="chapter_no" name="chapter_no" required>
                    <option id="chapter_no_0" value="">-- Select Chapter ---</option>
                    {selectOptions}
                </select>
            </div>
        );
    }
});
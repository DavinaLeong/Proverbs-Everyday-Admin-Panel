var Chapter = React.createClass({
    render: function() {
        return (
            <div>
                <h1>Chapter {this.props.chapterNo} ({this.props.abbr})</h1>
                <p className="date">{this.props.today}</p>
            </div>
        );
    }
});

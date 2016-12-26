var Chapter = React.createClass({
    render: function() {
        return (
            <div>
                <h1>Chapter {this.props.chapterNo} ({this.props.abbr})</h1>
                <p className="date">{this.props.today}</p>

                <Passage siteUrl={this.props.siteUrl}
                    siteTitle{this.props.siteTitle}
                    abbr={this.props.abbr}
                    chapterNo={this.props.chapterNo} />
            </div>
        );
    }
});

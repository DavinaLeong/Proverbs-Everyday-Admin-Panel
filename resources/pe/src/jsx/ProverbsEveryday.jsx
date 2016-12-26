var ProverbsEveryday = React.createClass({
    render: function () {
        return (
            <div>
                <Navbar siteTitle={this.props.siteTitle}
                        siteUrl={this.props.siteUrl}
                        chapterNo={this.props.chapterNo}
                        abbr={this.props.abbr}
                        translations={this.props.translations}
                />
                <div className="header"></div>
                <div className="container">
                    <Chapter
                        siteUrl={this.props.siteUrl}
                        today={this.props.today}
                        chapterNo={this.props.chapterNo}
                        abbr={this.props.abbr}
                        chapterPassage={this.props.chapterPassage}
                        versePassage={this.props.versePassage}
                    />
                </div>
            </div>
        );
    }
});

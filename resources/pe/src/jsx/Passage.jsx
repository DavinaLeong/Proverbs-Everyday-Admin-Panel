var Passage = React.createClass({
    var prevChapterNo = this.props.chaptetNo > 0 ? this.props.chapterNo - 1 : 1;
    var prevUrl = this.props.siteUrl + '/' + this.props.abbr + '/' + prevChapterNo;

    var nextChapterNo = this.props.chapterNo < 31 ? this.props.chapterNo + 1 : 31;
    var nextUrl = this.props.siteUrl + '/' + this.props.abbr + '/' + nextChapterNo;

    render: function() {
        return (
            <table>
                <tr>
                    {/* left-chevron start */}
                    <td className="col-xs-1 text-center">
                        <a className="chevron-link" href={prevUrl} data-toggle="tooltip" title={prevChapterNo}>
                            <span className="hidden-xs"><i className="fa fa-angle-left fa-3x"></i></span>
                            <span className="visible-xs"><i className="fa fa-angle-left fa-lg"></i></span>
                        </a>
                    </td>
                    {/* left-chevron end */}

                    {/* right-chevron start */}
                    <td className="col-xs-1 text-center">
                        <a className="chevron-link" href={nextUrl} data-toggle="tooltip" title={nextChapterNo}>
                            <span className="hidden-xs"><i className="fa fa-angle-right fa-3x"></i></span>
                            <span className="visible-xs"><i className="fa fa-angle-right fa-lg"></i></span>
                        </a>
                    </td>
                    {/* right-chevron end */}
                </tr>
            </table>
        );
    }
})

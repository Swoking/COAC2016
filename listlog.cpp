#include "listlog.h"
#include <QStandardItemModel>
#include <QSqlQuery>
#include "database.h"

ListLog::ListLog(COAC *parentFenetre, Database *database) :
    MyList(parentFenetre, database)
{
    this->setWindowTitle("liste des logs");

    showList();

}

void ListLog::showList(){

    if(db->getDB().isOpen()){

        QSqlQuery queryLog;
        queryLog.prepare("SELECT * FROM Journalisation;");
        queryLog.exec();

        QStandardItemModel *model = new QStandardItemModel();
        while (queryLog.next()) {
            qDebug() << "ListLog::showList() > ajout d'un log a la liste.";
            QStandardItem *itemClasse = new QStandardItem();
            itemClasse->setText( queryLog.value(2).toString() );
            itemClasse->setFlags(itemClasse->flags() & ~Qt::ItemIsEditable);
            model->appendRow(itemClasse);
        }
        myTreeList->setModel(model);
    }

}
